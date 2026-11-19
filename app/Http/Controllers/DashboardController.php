<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        /* 🔥 NORMALIZE STATUS (fix inconsistent data) */
        DB::table('leads')->whereRaw("LOWER(status) = 'contacted'")->update(['status' => 'Contacted']);
        DB::table('leads')->whereRaw("LOWER(status) = 'new'")->update(['status' => 'New']);
        DB::table('leads')->whereRaw("LOWER(status) = 'converted'")->update(['status' => 'Converted']);

        /* 📊 COUNTS */
        $totalLeads = DB::table('leads')->count();
        $totalCustomers = DB::table('customers')->count();

        $newLeads = DB::table('leads')->where('status', 'New')->count();
        $contactedLeads = DB::table('leads')->where('status', 'Contacted')->count();
        $convertedLeads = DB::table('leads')->where('status', 'Converted')->count();

        /* 📋 RECENT DATA */
        $recentLeads = DB::table('leads')->latest()->limit(5)->get();
        $recentCustomers = DB::table('customers')->latest()->limit(5)->get();

        /* ⚙️ SETTINGS (DYNAMIC) */
        $taxPercent = DB::table('settings')
        ->where('name', 'tax_percent')
        ->value('value') ?? 0;

        $taxType = DB::table('settings')
        ->where('name', 'tax_type')
        ->value('value') ?? 'Exclusive';

        $subsidyPercent = DB::table('settings')
        ->where('name', 'subsidy_percent')
        ->value('value') ?? 0;

        /* 🚀 RETURN VIEW */
        return view('dashboard', compact(
            'totalLeads',
            'totalCustomers',
            'newLeads',
            'contactedLeads',
            'convertedLeads',
            'recentLeads',
            'recentCustomers',
            'taxPercent',
            'taxType',
            'subsidyPercent'
        ));
    }
}