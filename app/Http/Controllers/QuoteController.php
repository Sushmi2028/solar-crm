<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->get();
        return view('quotations.index', compact('quotes'));
    }
    public function create()
    {
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'system' => 'required',
            'base' => 'required|numeric'
        ]);

        $base = $request->base;
        $tax = ($base * 18) / 100;
        $final = $base + $tax;

        Quote::create([
            'customer' => $request->customer,
            'system' => $request->system,
            'base' => $base,
            'tax' => $tax,
            'final' => $final,
            'status' => 'Pending'
        ]);

        // ✅ Redirect to index page after saving
        return redirect('/quotations/index')->with('success', 'Quote created successfully!');
    }
}