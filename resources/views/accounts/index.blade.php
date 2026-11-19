@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-4">Financial Dashboard</h4>
<div class="row mb-5">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-blue">
            <h6>Total Sales</h6>
            <h3>₹ {{ number_format($totalSales,2) }}</h3>
            <i class="fa fa-chart-line"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-green">
            <h6>Total Payments</h6>
            <h3>₹ {{ number_format($totalPayments,2) }}</h3>
            <i class="fa fa-money-bill-wave"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-red">
            <h6>Total Expenses</h6>
            <h3>₹ {{ number_format($totalExpenses,2) }}</h3>
            <i class="fa fa-wallet"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-orange">
            <h6>Net Profit</h6>
            <h3>₹ {{ number_format($profit,2) }}</h3>
            <i class="fa fa-coins"></i>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-dark text-white">
        Recent Payments
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            @forelse($payments as $p)
            <tr>
                <td>#{{ $p->invoice_id }}</td>
                <td>₹ {{ number_format($p->amount,2) }}</td>
                <td>{{ $p->payment_date }}</td>
            </tr>

            @empty
            <tr>
                <td colspan="3">No payment records found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection