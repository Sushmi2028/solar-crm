<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\QuoteController;
use App\Models\User;
use App\Models\Lead;
use App\Models\Customer;

/* ---------- COMMON HELPERS ---------- */
function checkLogin() {
    if (!session()->has('user')) return redirect('/login');
}
function checkAdmin() {
    if (session('role') != 'Admin') return redirect('/dashboard');
}
function normalize($value) {
    return ucfirst(strtolower($value));
}
function logActivity($action) {
    DB::table('audit_logs')->insert([
        'user' => session('user'),
        'action' => $action,
        'created_at' => now()
    ]);
}

/* ---------- AUTH ---------- */
Route::get('/', fn() => view('auth.login'));
Route::get('/login', fn() => view('auth.login'));
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user = DB::table('users')->where('email', $request->email)->first();
    if (!$user) return back()->with('error', 'User not found');
    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Invalid Password');
    }
    session([
        'user' => $user->username,
        'role' => trim($user->role) 
    ]);
    return redirect('/dashboard');
});
Route::post('/logout', function () {
    session()->flush();
    return redirect('/login');
});

/* ---------- REGISTER ---------- */
// Show register page
Route::get('/register', function () {
    return view('auth.register');
});

// Handle register
Route::post('/register', function (Request $request) {
    $request->validate([
        'username' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|digits:10',
        'password' => 'required|min:6',
        'role' => 'required'
    ]);
    DB::table('users')->insert([
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => $request->role, // ✅ DO NOT normalize here
        'created_at' => now(),
        'updated_at' => now()
    ]);
    session([
        'user' => $request->username,
        'role' => $request->role
    ]);
    return redirect('/dashboard')->with('success', 'Registered Successfully');
});

// Forgot Password Page
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email'
    ]);
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'User not found']);
    }
    // redirect to reset page with email
    return redirect('/reset-password?email=' . $request->email);
});

// Handle Password Reset
Route::get('/reset-password', function (Illuminate\Http\Request $request) {
    return view('auth.reset-password', [
        'email' => $request->email
    ]);
});

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'User not found']);
    }
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect('/login')->with('status', 'Password updated successfully!');
});

/* ---------- DASHBOARD ---------- */
Route::get('/dashboard', function () {
    if ($r = checkLogin()) return $r;
    return view('dashboard', [
        'totalLeads' => DB::table('leads')->count(),
        'totalCustomers' => DB::table('customers')->count(),
        'totalProducts' => DB::table('products')->count(),
        'newLeads' => DB::table('leads')->whereRaw('LOWER(status)="new"')->count(),
        'contactedLeads' => DB::table('leads')->whereRaw('LOWER(status)="contacted"')->count(),
        'convertedLeads' => DB::table('leads')->whereRaw('LOWER(status)="converted"')->count(),
        'recentLeads' => DB::table('leads')->latest()->limit(5)->get(),
        'recentCustomers' => DB::table('customers')->latest()->limit(5)->get()
    ]);
});

/* ---------- ADMIN MODULE ---------- */
// Users
Route::get('/admin/users', function (Request $request) {
    if ($r = checkAdmin()) return $r;
    $query = DB::table('users');
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('username', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%")
              ->orWhere('phone', 'like', "%{$request->search}%");
        });
    }
    if ($request->role) {
        $query->where('role', normalize($request->role));
    }
    $users = $query->orderBy('id', 'desc')->paginate(5);
    return view('admin.users', compact('users'));
});

// Add User
Route::get('/admin/users/create', function () {
    if ($r = checkAdmin()) return $r;

    return view('admin.create');
});

Route::post('/admin/users/store', function (Request $request) {
    if ($r = checkAdmin()) return $r;
    $request->validate([
        'username' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|digits:10',
        'password' => 'required|min:6',
        'role' => 'required'
    ]);
    DB::table('users')->insert([
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => normalize($request->role),
        'created_at' => now(),
        'updated_at' => now()
    ]);
    logActivity('Added new user');
    return redirect('/admin/users')->with('success', 'User added');
});

Route::get('/admin/users/edit/{id}', function ($id) {
    if ($r = checkAdmin()) return $r;
    $user = DB::table('users')->where('id', $id)->first();
    if (!$user) {
        return redirect('/admin/users')->with('error', 'User not found');
    }
    return view('admin.edit', compact('user'));
});

Route::post('/admin/users/update/{id}', function (Request $request, $id) {
    if ($r = checkAdmin()) return $r;
    $request->validate([
        'username' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|digits:10',
        'role' => 'required'
    ]);
    DB::table('users')
        ->where('id', $id)
        ->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => normalize($request->role),
            'updated_at' => now()
        ]);
    logActivity('Updated user');
    return redirect('/admin/users')->with('success', 'User updated successfully');
});

Route::get('/admin/users/delete/{id}', function ($id) {
    if ($r = checkAdmin()) return $r;
    DB::table('users')->where('id', $id)->delete();
    logActivity('Deleted user');
    return redirect('/admin/users')->with('success', 'User deleted successfully');
});


/* ---------- PRODUCTS (NEW) ---------- */
Route::get('/admin/products', function () {
    if ($r = checkAdmin()) return $r;
    $products = DB::table('products')->get();
    return view('admin.products', compact('products'));
});

Route::post('/admin/products/store', function (Request $request) {
    if ($r = checkAdmin()) return $r;
    $request->validate([
        'name' => 'required',
        'category' => 'required', // ✅ ADD VALIDATION
        'price' => 'required|numeric'
    ]);
    DB::table('products')->insert([
        'name' => $request->name,
        'category' => $request->category, // ✅ THIS LINE FIXES YOUR ERROR
        'price' => $request->price,
        'stock' => 0,
        'min_stock' => $request->min_stock ?? 5,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return back()->with('success', 'Product added');
});

/* ---------- TAX & SUBSIDY ---------- */
// VIEW SETTINGS
Route::get('/admin/settings', function () {
    if (session('role') != 'Admin') return redirect('/dashboard');
    $settings = DB::table('settings')->get();
    return view('admin.settings', compact('settings'));
});

// SAVE (INSERT / UPDATE)
Route::post('/admin/settings/save', function (Request $request) {
    DB::table('settings')->updateOrInsert(
    ['name' => $request->key],   // 👈 change here
    [
        'value' => $request->value,
        'updated_at' => now()
    ]
);
    return back()->with('success', 'Setting saved');
});

// DELETE
Route::get('/admin/settings/delete/{id}', function ($id) {
    DB::table('settings')->where('id', $id)->delete();
    return back()->with('success', 'Setting deleted');
});

/* ---------- AUDIT LOGS ---------- */
Route::get('/admin/logs', function () {
    if ($r = checkAdmin()) return $r;
    $logs = DB::table('audit_logs')->latest()->paginate(10);
    return view('admin.logs', compact('logs'));
});

/* ---------- REPORTS ---------- */
Route::get('/admin/reports', function (Request $request) {
    if (session('role') != 'Admin') return redirect('/dashboard');
    $query = DB::table('leads');

    // Filter
    if ($request->filter == 'today') {
        $query->whereDate('created_at', today());
    } elseif ($request->filter == 'month') {
        $query->whereMonth('created_at', now()->month);
    } elseif ($request->filter == 'year') {
        $query->whereYear('created_at', now()->year);
    }

    return view('admin.reports', [
        'totalUsers' => DB::table('users')->count(),
        'totalCustomers' => DB::table('customers')->count(),
        'totalLeads' => $query->count(),

        // ✅ ADD THESE (IMPORTANT)
        'newLeads' => (clone $query)->whereRaw('LOWER(status)="new"')->count(),
        'contactedLeads' => (clone $query)->whereRaw('LOWER(status)="contacted"')->count(),
        'convertedLeads' => (clone $query)->whereRaw('LOWER(status)="converted"')->count(),
        'recentUsers' => DB::table('users')->latest()->limit(5)->get()
    ]);
});

/* ---------- EXPORT ---------- */
Route::get('/admin/export/excel', function () {
    $leads = DB::table('leads')->get();
    return response()->stream(function () use ($leads) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Name', 'Email', 'Phone', 'Status']);

        foreach ($leads as $lead) {
            fputcsv($file, [$lead->name, $lead->email, $lead->phone, $lead->status]);
        }

        fclose($file);
    }, 200, [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=leads.csv"
    ]);
});

Route::get('/admin/export/pdf', function () {
    $leads = DB::table('leads')->get();
    return Pdf::loadView('admin.reports_pdf', compact('leads'))->download('report.pdf');
});

/* ---------- LEADS ---------- */
Route::get('/leads', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $query = DB::table('leads');
    if ($request->search) {
        $query->where('name', 'like', "%{$request->search}%")
              ->orWhere('phone', 'like', "%{$request->search}%");
    }
    if ($request->status) {
        $query->whereRaw('LOWER(status)=?', [strtolower($request->status)]);
    }
    $leads = $query->latest()->paginate(5);
    return view('leads.index', compact('leads'));
});

Route::get('leads/create', function () {
    return view('leads.create');
});

Route::post('/leads/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'name' => 'required|min:3',
        'phone' => 'required|digits:10'
    ]);

    DB::table('leads')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'status' => normalize($request->status ?? 'New'),
        'created_at' => now(),
        'updated_at' => now()
    ]);
    logActivity('Added lead');
    return redirect('/leads');
});

Route::get('/leads/edit/{id}', function ($id) {
    $lead = Lead::find($id);
    if (!$lead) {
        return back()->with('error', 'Lead not found');
    }
    return view('leads.edit', compact('lead'));
});

Route::post('leads/update/{id}', function (Request $request, $id) {
    $lead = Lead::find($id);
    if (!$lead) {
        return back()->with('error', 'Lead not found');
    }
    $lead->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'status' => $request->status
    ]);
    return redirect('leads')->with('success', 'Lead updated successfully');
});

Route::get('leads/delete/{id}', function ($id) {
    $lead = Lead::find($id);
    if (!$lead) {
        return back()->with('error', 'Lead not found');
    }
    $lead->delete();
    return back()->with('success', 'Lead deleted successfully');
});

Route::get('leads/convert/{id}', function ($id) {
    $lead = Lead::find($id);
    if (!$lead) {
        return back()->with('error', 'Lead not found');
    }
    Customer::create([
        'name' => $lead->name,
        'email' => $lead->email,
        'phone' => $lead->phone
    ]);
    $lead->status = 'Converted';
    $lead->save();
    return back()->with('success', 'Lead converted to customer successfully');
});

/* ---------- CUSTOMERS ---------- */
Route::get('/customers', function () {
    if ($r = checkLogin()) return $r;
    $customers = DB::table('customers')->latest()->paginate(5);
    return view('customers.index', compact('customers'));
});

Route::get('/customers/view/{id}', function ($id) {
    $customer = Customer::find($id);
    if (!$customer) {
        return back()->with('error', 'Customer not found');
    }
    return view('customers.show', compact('customer'));
});

Route::get('/customers/edit/{id}', function ($id) {
    $customer = Customer::find($id);
    if (!$customer) {
        return back()->with('error', 'Customer not found');
    }
    return view('customers.edit', compact('customer'));
});

Route::post('/customers/update/{id}', function (Request $request, $id) {
    $customer = Customer::find($id);
    $customer->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone
    ]);
    return redirect('/customers')->with('success', 'Customer updated');
});

Route::get('/customers/delete/{id}', function ($id) {
    $customer = Customer::find($id);
    $customer->delete();
    return back()->with('success', 'Customer deleted');
});


/* ---------- SALES MODULE ---------- */
/* ---------- SITE SURVEYS ---------- */
// View Surveys
Route::get('/surveys', function () {
    if ($r = checkLogin()) return $r;
    $surveys = DB::table('site_surveys')
        ->join('customers', 'site_surveys.customer_id', '=', 'customers.id')
        ->select('site_surveys.*', 'customers.name as customer_name')
        ->orderByDesc('site_surveys.id')
        ->get();
    return view('surveys.index', compact('surveys'));
});

// Create Survey Page
Route::get('/surveys/create', function () {
    if ($r = checkLogin()) return $r;
    $customers = DB::table('customers')->get();
    return view('surveys.create', compact('customers'));
});

// Store Survey
Route::post('/surveys/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'customer_id' => 'required',
        'location' => 'required',
        'roof_type' => 'required',
        'area_size' => 'required'
    ]);

    DB::table('site_surveys')->insert([
        'customer_id' => $request->customer_id,
        'location' => $request->location,
        'roof_type' => $request->roof_type,
        'area_size' => $request->area_size,
        'remarks' => $request->remarks,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    logActivity('Added site survey');

    return redirect('/surveys')->with('success', 'Survey saved');
});

/* ---------- QUOTATIONS ---------- */
/* ---------- VIEW QUOTATIONS ---------- */
Route::get('/quotations', function () {
    if ($r = checkLogin()) return $r;
    $quotes = DB::table('quotations')
        ->join('customers', 'quotations.customer_id', '=', 'customers.id')
        ->select(
            'quotations.*',
            'customers.name as customer_name'
        )
        ->orderByDesc('quotations.id')
        ->get();
    return view('quotations.index', compact('quotes'));
});

// Create Page
Route::get('/quotations/create', function () {
    if ($r = checkLogin()) return $r;

    $customers = DB::table('customers')->get();
    $surveys = DB::table('site_surveys')
        ->leftJoin(
            'customers',
            'site_surveys.customer_id',
            '=',
            'customers.id'
        )
        ->select(
            'site_surveys.*',
            'customers.name as customer_name'
        )
        ->get();
    return view(
        'quotations.create',
        compact('customers', 'surveys')
    );
});

/* ---------- STORE QUOTATION ---------- */
Route::post('/quotations/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    /* ---------- VALIDATION ---------- */
    $request->validate([
        'customer_id' => 'required',
        'system_size' => 'required',
        'base_price' => 'required|numeric|min:1'
    ]);

    /* ---------- GET TAX PERCENT ---------- */
    $taxPercent = DB::table('settings')
        ->where('name', 'tax_percent')
        ->value('value');
    $taxPercent = !empty($taxPercent)
        ? (float)$taxPercent
        : 0;

    /* ---------- CALCULATIONS ---------- */
    $base = (float)$request->base_price;
    $tax = round(($base * $taxPercent) / 100, 2);
    $final = round($base + $tax, 2);

    /* ---------- INSERT QUOTATION ---------- */
    DB::table('quotations')->insert([
        'customer_id' => $request->customer_id,
        'survey_id' => $request->survey_id ?? null,
        'system_size' => $request->system_size,
        'base_price' => $base,
        'tax' => $tax,
        'final_price' => $final,
        'status' => 'Pending',
        'created_at' => now(),
        'updated_at' => now()

    ]);

    /* ---------- ACTIVITY LOG ---------- */
    logActivity(
        'Created quotation for customer ID ' .
        $request->customer_id
    );
    return redirect('/quotations')
        ->with(
            'success',
            'Quotation created successfully'
        );
});

/* ---------- ORDERS ---------- */
// Confirm Order
Route::get('/orders/confirm/{id}', function ($id) {
    if ($r = checkLogin()) return $r;
    $quote = DB::table('quotations')->where('id', $id)->first();
    if (!$quote) return back();
    DB::beginTransaction();

    try {
        DB::table('orders')->insert([
            'quotation_id' => $quote->id,
            'customer_id' => $quote->customer_id,
            'order_date' => now(),
            'status' => 'Confirmed',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $product = DB::table('products')->first();
        if ($product && $product->stock > 0) {
            DB::table('products')
                ->where('id', $product->id)
                ->decrement('stock', 1);

            DB::table('stock_transactions')->insert([
                'product_id' => $product->id,
                'warehouse_id' => 1,
                'type' => 'OUT',
                'quantity' => 1,
                'remarks' => 'Auto deduction on order',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        DB::table('quotations')->where('id', $id)
            ->update(['status' => 'Approved']);

        DB::commit();
        return redirect('/quotations')->with('success', 'Order confirmed & stock updated');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong');
    }
});

/* ---------- AGREEMENTS ---------- */
// View Agreements
Route::get('/agreements', function () {

    // 🔐 Login check
    if ($r = checkLogin()) return $r;

    // 📦 Fetch agreements with customer name
    $agreements = DB::table('agreements')
        ->join('customers', 'agreements.customer_id', '=', 'customers.id')
        ->select(
            'agreements.*',
            'customers.name as customer_name'
        )
        ->orderByDesc('agreements.id')
        ->get();

    // 📄 Return view
    return view('agreements.index', compact('agreements'));
});

//Create Agreement Page
Route::get('/agreements/create', function () {

    // 🔐 Login check
    if ($r = checkLogin()) return $r;

    // 👤 Customers list
    $customers = DB::table('customers')->get();

    // 📦 Orders list
    $orders = DB::table('orders')->get();

    return view('agreements.create', compact('customers', 'orders'));
});

//Store Agreement
Route::post('/agreements/store', function (Request $request) {

    // 🔐 Login check
    if ($r = checkLogin()) return $r;

    // ✅ Validate input
    $request->validate([
        'customer_id' => 'required',
        'order_id' => 'required',
        'file' => 'required|file|mimes:pdf,jpg,jpeg,png'
    ]);

    // 📁 Store file in storage/app/public/agreements
    $filePath = $request->file('file')->store('agreements', 'public');

    // 💾 Insert into DB
    DB::table('agreements')->insert([
        'customer_id' => $request->customer_id,
        'order_id' => $request->order_id,
        'file' => $filePath,
        'status' => 'Signed',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // 📝 Log activity
    logActivity('Agreement uploaded');

    // 🔁 Redirect back
    return redirect('/agreements')->with('success', 'Agreement uploaded successfully!');
});

/* ---------- INVENTORY ---------- */

// 🔹 Inventory Dashboard
Route::get('/inventory', function () {
    if ($r = checkLogin()) return $r;
    $products = DB::table('products')->get();
    $chartLabels = $products->pluck('name');
    $chartStock = $products->pluck('stock');

    $chartUsage = $products->map(function ($p) {
        return DB::table('stock_transactions')
            ->where('product_id', $p->id)
            ->where('type', 'OUT')
            ->sum('quantity');
    });
    $lowStock = DB::table('products')
        ->whereColumn('stock', '<=', 'min_stock')
        ->get();

    return view('inventory.index', compact(
        'products',
        'lowStock',
        'chartLabels',
        'chartStock',
        'chartUsage'
    ));
});

// 🔹 Add Product Page
Route::get('/inventory/create', function () {
    if ($r = checkLogin()) return $r;
    $warehouses = DB::table('warehouses')
        ->orderBy('name')
        ->get();
    return view('inventory.create', compact(
        'warehouses'
    ));
});

// 🔹 Store Product
Route::post('/inventory/store', function (Request $request) {
    DB::table('products')->insert([
        'name' => $request->name,
        'category' => $request->category,
        'price' => $request->price,
        'stock' => 0,
        'min_stock' => $request->min_stock ?? 5,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return redirect('/inventory')->with('success', 'Product added');
});

// 🔹 Warehouses Page (FIXED login check)
Route::get('/warehouses', function () {
    if ($r = checkLogin()) return $r;
    $warehouses = DB::table('warehouses')->get();
    return view('inventory.warehouses', compact('warehouses'));
});

// 🔹 Add Warehouse
Route::post('/warehouses/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'name' => 'required',
        'location' => 'required'
    ]);
    DB::table('warehouses')->insert([
        'name' => $request->name,
        'location' => $request->location,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    logActivity('Added warehouse');
    return back()->with('success', 'Warehouse added');
});

// 🔹 Stock IN
Route::post('/stock/in', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1'
    ]);
    DB::beginTransaction();
    try {
        DB::table('stock_transactions')->insert([
            'product_id' => $request->product_id,
            'warehouse_id' => $request->warehouse_id ?? null,
            'type' => 'IN',
            'quantity' => $request->quantity,
            'remarks' => $request->remarks,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('products')
            ->where('id', $request->product_id)
            ->increment('stock', $request->quantity);

        logActivity('Stock added');
        DB::commit();
        return back()->with('success', 'Stock added successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong');
    }
});

// 🔹 Stock OUT
Route::post('/stock/out', function (Request $request) {

    if ($r = checkLogin()) return $r;

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1'
    ]);

    DB::beginTransaction();

    try {
        $product = DB::table('products')->where('id', $request->product_id)->first();
        if (!$product) {
            return back()->with('error', 'Product not found');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock');
        }

        DB::table('stock_transactions')->insert([
            'product_id' => $request->product_id,
            'warehouse_id' => $request->warehouse_id ?? null,
            'type' => 'OUT',
            'quantity' => $request->quantity,
            'remarks' => $request->remarks,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')
            ->where('id', $request->product_id)
            ->decrement('stock', $request->quantity);

        logActivity('Stock removed');

        DB::commit();

        return back()->with('success', 'Stock removed successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong');
    }
});

// 🔹 Stock History
Route::get('/stock/history', function () {
    if ($r = checkLogin()) return $r;
    $transactions = DB::table('stock_transactions')
        ->join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->leftJoin('warehouses', 'stock_transactions.warehouse_id', '=', 'warehouses.id')
        ->select(
            'stock_transactions.*',
            'products.name as product_name',
            'warehouses.name as warehouse_name'
        )
        ->latest()
        ->get();

    return view('stock.history', compact('transactions'));
});


// 🔹 Export CSV
Route::get('/inventory/export/csv', function () {

    if ($r = checkLogin()) return $r;
    $products = DB::table('products')->get();
    return response()->stream(function () use ($products) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Name', 'Category', 'Stock', 'Min Stock']);
        foreach ($products as $p) {
            fputcsv($file, [
                $p->name,
                $p->category,
                $p->stock,
                $p->min_stock
            ]);
        }
        fclose($file);
    }, 200, [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=inventory.csv"
    ]);
});

// 🔹 Export PDF
Route::get('/inventory/export/pdf', function () {

    if ($r = checkLogin()) return $r;

    $products = DB::table('products')->get();

    return Pdf::loadView('inventory.pdf', compact('products'))
        ->download('inventory.pdf');
});


/* Installation & Project Module */
// LIST INSTALLATIONS
Route::get('/installations', function () {

    $installations = DB::table('installations')
        ->join('customers','installations.customer_id','=','customers.id')
        ->leftJoin('engineers','installations.engineer_id','=','engineers.id')
        ->select(
            'installations.*',
            'customers.name as customer_name',
            'engineers.name as engineer_name'
        )
        ->orderByDesc('installations.id')
        ->get();

    return view('installations.index', compact('installations'));
});

// CREATE INSTALLATION PAGE
Route::get('/installations/create', function () {

    $customers = DB::table('customers')->get();
    $quotations = DB::table('quotations')->get();
    $engineers = DB::table('engineers')->get();
    return view('installations.create', compact('customers','quotations','engineers'));
});

// VIEW INSTALLATION DETAILS
Route::get('/installations/{id}', function ($id) {

    $installation = DB::table('installations')
        ->where('id', $id)
        ->first();

    if (!$installation) {
        return redirect('/installations')
            ->with('error', 'Installation not found');
    }
    return view('installations.show', compact('installation'));
});

//STORE INSTALLATION
Route::post('/installations/store', function (Request $request) {
    $request->validate([
        'quotation_id' => 'required',
        'customer_id' => 'required',
        'engineer_id' => 'required',
        'schedule_date' => 'required|date',
        'project_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'installation_document' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:4096'
    ]);
    $projectPhoto = null;
    $installationDocument = null;

    /* ---------- PROJECT PHOTO ---------- */
    if ($request->hasFile('project_photo')) {
        $projectPhoto = $request
            ->file('project_photo')
            ->store('installation_photos', 'public');
    }

    /* ---------- INSTALLATION DOCUMENT ---------- */
    if ($request->hasFile('installation_document')) {
        $installationDocument = $request
            ->file('installation_document')
            ->store('installation_documents', 'public');
    }

    DB::table('installations')->insert([
        'quotation_id' => $request->quotation_id,
        'customer_id' => $request->customer_id,
        'engineer_id' => $request->engineer_id,
        'schedule_date' => $request->schedule_date,
        'project_photo' => $projectPhoto,
        'installation_document' => $installationDocument,
        'status' => 'Scheduled',
        'progress' => 0,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return redirect('/installations')
        ->with('success', 'Installation created successfully');
});

// ASSIGN ENGINEER
Route::post('/installations/assign-engineer', function (Request $request) {

    DB::table('installations')
        ->where('id', $request->installation_id)
        ->update([
            'engineer_id' => $request->engineer_id,
            'status' => 'Assigned'
        ]);

    return back();
});

// UPDATE PROGRESS
Route::post('/installations/update-progress', function (Request $request) {

    DB::table('installations')
        ->where('id', $request->installation_id)
        ->update([
            'progress' => $request->progress,
            'status' => $request->progress == 100 ? 'Completed' : 'In Progress'
        ]);

    return back();
});

// ADD MATERIALS
Route::post('/installations/materials/store', function (Request $request) {

    DB::table('installation_materials')->insert([
        'installation_id' => $request->installation_id,
        'material_name' => $request->material_name,
        'quantity' => $request->quantity,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return back();
});

//UPLOAD FILES
Route::post('/installations/upload', function (Request $request) {

    if ($r = checkLogin()) return $r;

    $request->validate([
        'installation_id' => 'required',
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        'stage' => 'nullable|string'
    ]);

    // store file
    $path = $request->file('file')->store('installations', 'public');

    DB::table('installation_uploads')->insert([
        'installation_id' => $request->installation_id,
        'file_path' => $path,
        'file_type' => $request->file('file')->getClientOriginalExtension(),
        'stage' => $request->stage ?? 'general',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return back()->with('success', 'File uploaded successfully');
});

/* =========================================================
   BILLING & PAYMENT MANAGEMENT MODULE
========================================================= */

/* ---------- BILLING DASHBOARD ---------- */
Route::get('/billing', function () {
    if ($r = checkLogin()) return $r;
    $invoices = DB::table('invoices')
        ->leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
        ->select(
            'invoices.*',
            'customers.name as customer_name'
        )
        ->latest()
        ->get();
    return view('billing.index', compact('invoices'));
});

/* ---------- CREATE INVOICE PAGE ---------- */
Route::get('/billing/create', function () {
    if ($r = checkLogin()) return $r;
    $customers = DB::table('customers')->get();
    $quotations = DB::table('quotations')->get();
    return view('billing.create', compact(
        'customers',
        'quotations'
    ));
});

/* ---------- STORE INVOICE ---------- */
Route::post('/billing/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'customer_id' => 'required',
        'quotation_id' => 'required',
        'total_amount' => 'required|numeric|min:1'
    ]);

    // Get tax %
    $taxPercent = DB::table('settings')
        ->where('name', 'tax_percent')
        ->value('value') ?? 0;

    // Get subsidy %
    $subsidyPercent = DB::table('settings')
        ->where('name', 'subsidy_percent')
        ->value('value') ?? 0;

    // Calculations
    $total = (float)$request->total_amount;
    $taxAmount = ($total * $taxPercent) / 100;
    $subsidyAmount = ($total * $subsidyPercent) / 100;
    $finalAmount = ($total + $taxAmount) - $subsidyAmount;

    // Insert Invoice ONLY ONCE
    $invoiceId = DB::table('invoices')->insertGetId([
        'customer_id' => $request->customer_id,
        'quotation_id' => $request->quotation_id,
        'invoice_no' => 'INV-' . rand(1000,9999),
        'total_amount' => $total,
        'subsidy_amount' => $subsidyAmount,
        'tax_amount' => $taxAmount,
        'final_amount' => $finalAmount,
        'status' => 'Pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    /* CREATE MILESTONES AUTOMATICALLY */
    // 30% Advance
    DB::table('milestones')->insert([
        'invoice_id' => $invoiceId,
        'milestone_name' => 'Advance',
        'percentage' => 30,
        'amount' => ($finalAmount * 30) / 100,
        'status' => 'Pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // 40% Installation
    DB::table('milestones')->insert([
        'invoice_id' => $invoiceId,
        'milestone_name' => 'Installation',
        'percentage' => 40,
        'amount' => ($finalAmount * 40) / 100,
        'status' => 'Pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // 30% Final Payment
    DB::table('milestones')->insert([
        'invoice_id' => $invoiceId,
        'milestone_name' => 'Final Payment',
        'percentage' => 30,
        'amount' => ($finalAmount * 30) / 100,
        'status' => 'Pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    logActivity('Invoice generated');
    return redirect('/billing')
        ->with('success', 'Invoice generated successfully');
});

/* ---------- VIEW PAYMENTS ---------- */

Route::get('/payments/{invoice}', function ($invoice) {

    if ($r = checkLogin()) return $r;

    $invoiceData = DB::table('invoices')
        ->where('id', $invoice)
        ->first();

    if (!$invoiceData) {
        return redirect('/billing')
            ->with('error', 'Invoice not found');
    }

    $payments = DB::table('payments')
        ->where('invoice_id', $invoice)
        ->latest()
        ->get();

    $paid = DB::table('payments')
        ->where('invoice_id', $invoice)
        ->sum('amount');

    $due = $invoiceData->final_amount - $paid;

    return view('billing.payments', compact(
        'invoiceData',
        'payments',
        'paid',
        'due'
    ));
});

/* ---------- ADD PAYMENT ---------- */
Route::post('/payments/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'payment_type' => 'required',
        'amount' => 'required|numeric|min:1',
        'payment_date' => 'required'
    ]);
    DB::beginTransaction();

    try {
        // 🔹 Add Payment
        DB::table('payments')->insert([
            'invoice_id' => $request->invoice_id,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'remarks' => $request->remarks,
            'created_at' => now(),
            'updated_at' => now()

        ]);

        // 🔹 Update Milestone Status
        $milestone = DB::table('milestones')
            ->where('invoice_id', $request->invoice_id)
            ->where('milestone_name', $request->payment_type)
            ->first();

        if ($milestone) {
            DB::table('milestones')
                ->where('id', $milestone->id)
                ->update([
                    'status' => 'Paid',
                    'updated_at' => now()
                ]);
        }

        // 🔹 Get Invoice
        $invoice = DB::table('invoices')
            ->where('id', $request->invoice_id)
            ->first();

        // 🔹 Total Paid Amount
        $paid = DB::table('payments')
            ->where('invoice_id', $request->invoice_id)
            ->sum('amount');

        // 🔹 Update Invoice Status
        if ($invoice && $paid >= $invoice->final_amount) {
            DB::table('invoices')
                ->where('id', $request->invoice_id)
                ->update([
                    'status' => 'Paid',
                    'updated_at' => now()

                ]);
        } else {
            DB::table('invoices')
                ->where('id', $request->invoice_id)
                ->update([

                    'status' => 'Partial',
                    'updated_at' => now()

                ]);
        }
        logActivity('Payment added');
        DB::commit();
        return back()->with(
            'success',
            'Payment added successfully'
        );
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error','Something went wrong');
    }
});

/* ---------- VIEW MILESTONES ---------- */
Route::get('/milestones/{invoice}', function ($invoice) {
    if ($r = checkLogin()) return $r;
    $invoiceData = DB::table('invoices')
        ->where('id', $invoice)
        ->first();

    $milestones = DB::table('milestones')
        ->where('invoice_id', $invoice)
        ->get();

    return view('billing.milestones', compact(
        'invoiceData',
        'milestones'
    ));
});

/* =========================================================
   PROJECT HANDOVER MODULE
========================================================= */

/* ---------- HANDOVER DASHBOARD ---------- */
Route::get('/handover', function () {
    if ($r = checkLogin()) return $r;
    $handovers = DB::table('project_handovers')
        ->leftJoin(
            'customers',
            'project_handovers.customer_id',
            '=',
            'customers.id'
        )
        ->leftJoin(
            'orders',
            'project_handovers.order_id',
            '=',
            'orders.id'
        )
        ->select(
            'project_handovers.*',
            'customers.name as customer_name',
            'orders.id as order_number'
        )
        ->latest()
        ->get();
    return view(
        'handover.index',
        compact('handovers')
    );
});

/* ---------- CREATE HANDOVER PAGE ---------- */
Route::get('/handover/create', function () {
    if ($r = checkLogin()) return $r;
    $customers = DB::table('customers')
        ->orderBy('name')
        ->get();

    // ✅ Better order display
    $orders = DB::table('orders')
        ->join(
            'customers',
            'orders.customer_id',
            '=',
            'customers.id'
        )
        ->select(
            'orders.*',
            'customers.name as customer_name'
        )
        ->latest()
        ->get();
    return view(
        'handover.create',
        compact(
            'customers',
            'orders'
        )
    );
});

/* ---------- STORE HANDOVER ---------- */
Route::post('/handover/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'order_id' => 'required|exists:orders,id',
        'commissioning_date' => 'required|date',
        'handover_status' => 'required'
    ]);
    DB::beginTransaction();
    try {
        $warrantyFile = null;
        $amcFile = null;
        $signedDocument = null;

        /* ---------- WARRANTY DOCUMENT ---------- */
        if ($request->hasFile('warranty_document')) {
            $warrantyFile = $request
                ->file('warranty_document')
                ->store('handover_documents');
        }

        /* ---------- AMC DOCUMENT ---------- */
        if ($request->hasFile('amc_document')) {
            $amcFile = $request
                ->file('amc_document')
                ->store('handover_documents');
        }

        /* ---------- SIGNED DOCUMENT ---------- */
        if ($request->hasFile('signed_document')) {
            $signedDocument = $request
                ->file('signed_document')
                ->store('handover_documents');
        }

        /* ---------- INSERT HANDOVER ---------- */
        DB::table('project_handovers')->insert([
            'customer_id' => $request->customer_id,
            'order_id' => $request->order_id,
            'commissioning_date' => $request->commissioning_date,
            'warranty_document' => $warrantyFile,
            'amc_document' => $amcFile,
            'training_given' => $request->training_given ?? 'No',

            /* ---------- TRAINING CHECKLIST ---------- */
            'system_demo' =>
                $request->system_demo ?? 'No',
            'maintenance_training' =>
                $request->maintenance_training ?? 'No',
            'safety_guidelines' =>
                $request->safety_guidelines ?? 'No',
            'mobile_app_training' =>
                $request->mobile_app_training ?? 'No',

            /* ---------- FINAL SIGN-OFF ---------- */
            'signed_by' =>
                $request->signed_by,
            'signed_date' =>
                $request->signed_date,
            'signed_document' =>
                $signedDocument,

            /* ---------- HANDOVER ---------- */
            'handover_status' =>
                $request->handover_status,
            'remarks' =>
                $request->remarks,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        /* ---------- UPDATE ORDER STATUS ---------- */
        DB::table('orders')
            ->where('id', $request->order_id)
            ->update([
                'status' => 'Completed',
                'updated_at' => now()
            ]);
        logActivity('Project handover completed');
        DB::commit();
        return redirect('/handover')
            ->with(
                'success',
                'Project handover completed successfully'
            );
    } catch (\Exception $e) {
        DB::rollBack();
        return back()
            ->with(
                'error',
                'Something went wrong'
            );
    }
});

/* ---------- COMPLETE HANDOVER ---------- */
Route::get('/handover/complete/{id}', function ($id) {
    if ($r = checkLogin()) return $r;
    DB::table('project_handovers')
        ->where('id', $id)
        ->update([
            'handover_status' => 'Completed',
            'updated_at' => now()
        ]);
    logActivity('Project handover marked completed');
    return back()
        ->with(
            'success',
            'Handover marked as completed'
        );
});

/* =========================================================
   ACCOUNTANT MODULE
========================================================= */

/* ---------- ACCOUNTANT DASHBOARD ---------- */
Route::get('/accounts', function () {
    if ($r = checkLogin()) return $r;

    /* ---------- TOTAL SALES ---------- */
    $totalSales = DB::table('invoices')
        ->sum('final_amount');

    /* ---------- TOTAL PAYMENTS ---------- */
    $totalPayments = DB::table('payments')
        ->sum('amount');

    /* ---------- TOTAL EXPENSES ---------- */
    $totalExpenses = DB::table('expenses')
        ->sum('amount');

    /* ---------- PENDING DUES ---------- */
    $pendingDues = DB::table('invoices')
        ->where('status', '!=', 'Paid')
        ->sum('final_amount');

    /* ---------- PROFIT ---------- */
    $profit = $totalPayments - $totalExpenses;

    /* ---------- RECENT PAYMENTS ---------- */
    $payments = DB::table('payments')
        ->latest()
        ->limit(5)
        ->get();

    return view('accounts.index', compact(
        'totalSales',
        'totalPayments',
        'totalExpenses',
        'pendingDues',
        'profit',
        'payments'
    ));
});

/* ---------- SALES REPORT ---------- */
Route::get('/accounts/sales-report', function () {
    if ($r = checkLogin()) return $r;
    $sales = DB::table('invoices')
        ->join('customers', 'invoices.customer_id', '=', 'customers.id')
        ->select(
            'invoices.*',
            'customers.name as customer_name'
        )
        ->latest()
        ->get();

    /* ---------- SUMMARY CARDS ---------- */
    $totalRevenue = DB::table('invoices')
        ->sum('final_amount');

    $paidRevenue = DB::table('invoices')
        ->where('status', 'Paid')
        ->sum('final_amount');

    $pendingRevenue = DB::table('invoices')
        ->where('status', '!=', 'Paid')
        ->sum('final_amount');

    $totalInvoices = DB::table('invoices')
        ->count();

    return view('accounts.sales-report', compact(
        'sales',
        'totalRevenue',
        'paidRevenue',
        'pendingRevenue',
        'totalInvoices'
    ));
});

/* ---------- PROFIT & LOSS ---------- */
Route::get('/accounts/profit-loss', function () {
    if ($r = checkLogin()) return $r;
    $income = DB::table('payments')
        ->sum('amount');

    $expenses = DB::table('expenses')
        ->sum('amount');

    $profit = $income - $expenses;
    return view('accounts.profit-loss', compact(
        'income',
        'expenses',
        'profit'
    ));
});

/* ---------- EXPENSES PAGE ---------- */
Route::get('/accounts/expenses', function () {
    if ($r = checkLogin()) return $r;
    $expenses = DB::table('expenses')
        ->latest()
        ->get();
    return view('accounts.expenses', compact('expenses'));
});

/* ---------- STORE EXPENSE ---------- */
Route::post('/accounts/expenses/store', function (Request $request) {
    if ($r = checkLogin()) return $r;
    $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric|min:1',
        'expense_date' => 'required'
    ]);

    DB::table('expenses')->insert([
        'title' => $request->title,
        'amount' => $request->amount,
        'expense_date' => $request->expense_date,
        'remarks' => $request->remarks,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    logActivity('Expense added');
    return back()->with(
        'success',
        'Expense added successfully'
    );
});
