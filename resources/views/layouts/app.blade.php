<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solar CRM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
body {
    margin: 0;
    background: #f8f9fc;
    font-family: 'Segoe UI', sans-serif;
}

/* DASHBOARD CARDS */
.dashboard-card {
    border-radius: 15px;
    margin-bottom: 30px;
    padding: 20px;
    color: white;
    font-weight: 600;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-5px);
}

/* Gradient cards */
.card-orange {
    background: linear-gradient(135deg, #f6c23e, #f97316);
}

.card-green {
    background: linear-gradient(135deg, #1cc88a, #13855c);
}

.card-blue {
    background: linear-gradient(135deg, #36b9cc, #258391);
}

.card-red {
    background: linear-gradient(135deg, #e74a3b, #a71d2a);
}
.gradient-blue{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
}
.gradient-green{
    background:linear-gradient(135deg,#10b981,#059669);
}
.stat-card{
    border-radius:20px;
    padding:25px;
    color:#fff;
    position:relative;
    overflow:hidden;
    transition:all 0.3s ease;
    cursor:pointer;
}

.stat-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,0.20);
}
.stat-card h6{
    font-size:15px;
    font-weight:500;
    margin-bottom:10px;
}
.stat-card h3{
    font-size:22px;
    font-weight:700;
    margin:0;
}
.stat-card i{
    position:absolute;
    top:25px;
    right:25px;
    font-size:36px;
    opacity:0.9;
}
.summary-card{
    border:none;
    border-radius:18px;
    padding:20px;
    color:#fff;
    transition:all .3s ease;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.summary-card:hover{
    transform:translateY(-5px);
}
/* LAYOUT */
.wrapper {
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    min-height: 100vh;
    background: linear-gradient(180deg, #f97316, #ea580c);
    color: white;
    padding: 20px;
}

.sidebar h4 {
    font-weight: 700;
    letter-spacing: 1px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    margin-bottom: 8px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    transition: 0.25s;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.2);
    transform: translateX(5px);
}

/* ACTIVE LINK */
.sidebar a.active {
    background: white;
    color: #f97316;
    font-weight: 600;
}

/* MAIN */
.main {
    flex: 1;
}

/* TOPBAR */
.topbar {
    background: white;
    padding: 15px 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* ROLE BADGE */
.role-badge {
    background: #1cc88a;
    padding: 5px 12px;
    border-radius: 20px;
    color: white;
    font-size: 12px;
}

/* CARD */
.card-box {
    border-radius: 15px;
    background: white;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.form-control{
    border-radius:12px;
    min-height:45px;
}
.form-control:focus{
    box-shadow:none;
    border-color:#4f46e5;
}
.page-header{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:#fff;
    border-radius:18px;
    padding:20px 25px;
    margin-bottom:25px;
}
.btn-save{
    border-radius:12px;
    padding:10px 25px;
}

/* TABLE */
.table thead {
    background: #f97316;
    color: white;
}
.table tbody tr:hover{
    background:#f8fafc;
}

/* BUTTON */
.btn-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
}
.btn-primary:hover {
    transform: translateY(-2px);
}
.btn-custom-sm {
    padding: 6px 14px;
    font-size: 14px;
    border-radius: 8px;
}

/* PAGINATION */
.pagination .page-link {
    border-radius: 10px !important;
}
</style>
</head>

<body>
<div class="wrapper">

    <!-- 🔥 SIDEBAR -->
    <div class="sidebar">
        <h4>☀ Solar CRM</h4>
        <hr>
        <!-- Dashboard -->
        <a href="/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a>

        <!-- 🔥 ADMIN MENU -->
        @if(session('role') == 'Admin')
            <a href="/admin/users"><i class="fa-solid fa-user"></i> Users</a>
            <a href="/admin/products"><i class="fa-solid fa-box"></i> Products</a>
            <a href="/admin/settings"><i class="fa-solid fa-gear"></i> Tax & Settings</a>
            <a href="/admin/logs"><i class="fa-solid fa-clock-rotate-left"></i> Audit Logs</a>
            <a href="/admin/reports"><i class="fa-solid fa-chart-pie"></i> Reports</a>
            <a href="/billing"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Billing</a>
            <a href="/handover"><i class="fa fa-handshake me-2"></i>Project Handover</a>
        @endif

        <!-- 🔥 SALES MENU -->
        @if(session('role') == 'Sales' || session('role') == 'Sales Executive')
            <a href="/leads"><i class="fa-solid fa-user-plus"></i> Leads </a>
            <a href="/customers"><i class="fa-solid fa-users"></i> Customers</a>
            <a href="/surveys"><i class="fa fa-map"></i> Surveys</a>
            <a href="/quotations"><i class="fa fa-file-invoice"></i> Quotations</a>
            <a href="/billing"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Billing</a>
        @endif

        <!-- INVENTORY -->
        @if(session('role') == 'Store / Inventory Manager')
            <a href="/inventory"><i class="fa-solid fa-boxes-stacked me-2"></i> Inventory Dashboard</a>
            <a href="/inventory/create"><i class="fa-solid fa-square-plus me-2"></i> Add Product</a>
            <a href="/stock/history"><i class="fa fa-right-left me-2"></i> Stock Transactions</a>
            <a href="/warehouses"><i class="fa-solid fa-warehouse me-2"></i>Warehouses</a>
        @endif

        <!-- ENGINEER -->
        @if(session('role') == 'Installation Engineer')
            <a class="nav-link" href="/installations"><i class="fa fa-tools"></i> Installations</a>
            <a class="nav-link" href="/installations/create"><i class="fa fa-plus-circle"></i> Create Installation</a>
        @endif

        <!-- ACCOUNTANT -->
        @if(session('role') == 'Accountant')
            <a href="/accounts"><i class="fa fa-chart-line me-2"></i>Financial Dashboard</a>            
            <a href="/billing"><i class="fa fa-file-invoice"></i> Billing</a>
            <a href="/accounts/sales-report"><i class="fa fa-file-invoice-dollar me-2"></i> Sales Reports</a>
            <a href="/accounts/profit-loss"><i class="fa fa-scale-balanced me-2"></i>Profit & Loss</a>
            <a href="/accounts/expenses"><i class="fa fa-money-bill-wave me-2"></i>Expenses</a>
        @endif

        @if(session('role') == 'Customer')
            <a class="nav-link" href="/customer/dashboard"><i class="fa fa-user-circle"></i>Customer Dashboard</a>
            <a class="nav-link" href="/customer/order-status"><i class="fa fa-shopping-cart"></i>Order Status</a>
            <a class="nav-link" href="/customer/documents"><i class="fa fa-file-pdf"></i>Warranty Documents</a>
            <a class="nav-link" href="/customer/payments"><i class="fa fa-credit-card"></i>Payment History</a>
        @endif

        <hr>
        <!-- Logout -->
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-light w-100">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>

    <!-- 🔥 MAIN -->
    <div class="main">
        <!-- TOPBAR -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Welcome, <strong>{{ session('user') }}</strong></h5>
            <span class="role-badge">{{ session('role') }}</span>
         </div>

        <!-- PAGE CONTENT -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>
</div>
@php
$lowCount = DB::table('products')
    ->whereColumn('stock','<=','min_stock')
    ->count();
@endphp

<!-- <a href="/inventory">
    <i class="fa fa-box"></i> Inventory
    @if($lowCount > 0)
        <span class="badge bg-danger">{{ $lowCount }}</span>
    @endif
</a> -->
</body>
</html>