@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-file-invoice-dollar text-primary me-2"></i>Generate Invoice</h4>
    <a href="/billing"class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">Invoice Information</h5>
    </div>

    <div class="card-body p-4">
        <form method="POST" action="/billing/store">
            @csrf
            <!-- Customer -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Customer</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">Select Customer</option>

                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quotation -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Quotation</label>
                <select name="quotation_id" class="form-control"required>
                    <option value="">Select Quotation</option>
                    @foreach($quotations as $q)
                        <option value="{{ $q->id }}">Quotation #{{ $q->id }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Total Amount (₹)</label>
                <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Enter Total Amount" required>
            </div>

            <!-- Button -->
            <div class="text-end">
                <button type="submit"class="btn btn-primary px-4">
                    <i class="fa fa-save me-1"></i>Generate Invoice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection