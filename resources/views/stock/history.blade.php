@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-clock-rotate-left text-primary me-2"></i>Stock History</h4>
    <a href="/inventory" class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Transactions</h6>
            <h3>{{ $transactions->count() }}</h3>
            <i class="fa fa-list"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-green">
            <h6>Stock In</h6>
            <h3>{{ $transactions->where('type','IN')->count() }}</h3>
            <i class="fa fa-arrow-down"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-red">
            <h6>Stock Out</h6>
            <h3>{{ $transactions->where('type','OUT')->count() }}</h3>
            <i class="fa fa-arrow-up"></i>
        </div>
    </div>
</div>

<!-- TRANSACTION TABLE -->
<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Transaction History</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Transaction Type</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td>
                        <strong>{{ $t->product_name }}</strong>
                    </td>
                    
                    <td>
                        @if($t->type == 'IN')
                            <span class="badge bg-success">Stock In</span>
                        @else
                            <span class="badge bg-danger">Stock Out</span>
                        @endif
                    </td>

                    <td>{{ $t->quantity }}</td>

                    <td>{{ date('d M Y', strtotime($t->created_at)) }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No stock transactions found
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection