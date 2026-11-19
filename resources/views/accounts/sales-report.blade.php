@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between mb-4">
    <h4 class="fw-bold">Sales & Revenue Report</h4>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Revenue</h6>
            <h3>₹ {{ number_format($totalRevenue,2) }}</h3>
            <i class="fa fa-chart-line"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-green">
            <h6>Paid Revenue</h6>
            <h3>₹ {{ number_format($paidRevenue,2) }}</h3>
            <i class="fa fa-money-bill-wave"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-red">
            <h6>Pending Revenue</h6>
            <h3>₹ {{ number_format($pendingRevenue,2) }}</h3>
            <i class="fa fa-wallet"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-orange">
            <h6>Total Invoices</h6>
            <h3>{{ $totalInvoices }}</h3>
            <i class="fa fa-file-invoice"></i>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white">
        Revenue Overview
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($sales as $s)
            <tr>
                <td>{{ $s->invoice_no }}</td>
                <td>{{ $s->customer_name }}</td>
                <td>
                    ₹ {{ number_format($s->final_amount,2) }}
                </td>

                <td>
                    <span class="badge bg-success">
                        {{ $s->status }}
                    </span>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="4">No sales records found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection