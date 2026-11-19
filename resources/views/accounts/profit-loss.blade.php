@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-4">Profit & Loss Analysis</h4>
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="stat-card card-green">
            <h6>Total Income</h6>
            <h3>₹ {{ number_format($income,2) }}</h3>
            <i class="fa fa-arrow-trend-up"></i>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card card-red">
            <h6>Total Expenses</h6>
            <h3>₹ {{ number_format($expenses,2) }}</h3>
            <i class="fa fa-arrow-trend-down"></i>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card card-blue">
            <h6>Net Profit</h6>
            <h3>₹ {{ number_format($profit,2) }}</h3>
            <i class="fa fa-scale-balanced"></i>
        </div>
    </div>
</div>

@if($profit > 0)
<div class="alert alert-success mt-4">
    <strong>Profit Status:</strong>Business is currently profitable.
</div>

@else
<div class="alert alert-danger mt-4">
    <strong>Profit Status:</strong>Expenses exceed income.
</div>
@endif
@endsection