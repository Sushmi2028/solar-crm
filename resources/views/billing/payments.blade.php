@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-credit-card me-2 text-primary"></i>Payment Tracking</h4>
    <div>
        <a href="/milestones/{{ $invoiceData->id }}"class="btn btn-info me-2"><i class="fa fa-flag-checkered me-1"></i>Milestones</a>
        <a href="/billing"class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
    </div>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Amount</h6>
            <h3>₹ {{ number_format($invoiceData->final_amount,2) }}</h3>
            <i class="fa fa-file-invoice"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-green">
            <h6>Paid Amount</h6>
            <h3>₹ {{ number_format($paid,2) }}</h3>
            <i class="fa fa-money-bill-wave"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="stat-card card-red">
            <h6>Outstanding Due</h6>
            <h3>₹ {{ number_format($due,2) }}</h3>
            <i class="fa fa-triangle-exclamation"></i>
        </div>
    </div>
</div>

<div class="row">
    <!-- PAYMENT FORM -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Add Payment</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="/payments/store">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoiceData->id }}">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Type</label>
                        <select name="payment_type" class="form-control"required>
                            <option value="">Select Payment Type</option>
                            <option value="Advance">Advance</option>
                            <option value="Milestone">Milestone</option>
                            <option value="Final">Final</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="Enter Amount" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Remarks</label>
                        <textarea name="remarks" rows="3" class="form-control" placeholder="Enter Remarks"></textarea>
                    </div>

                    <button type="submit"class="btn btn-success w-100">
                        <i class="fa fa-save me-1"></i>Add Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- PAYMENT HISTORY -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Payment History</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($payments as $p)
                        <tr>
                            <td>
                                @if($p->payment_type == 'Advance')
                                    <span class="badge bg-warning">Advance</span>
                                @elseif($p->payment_type == 'Milestone')
                                    <span class="badge bg-info">Milestone</span>
                                @else
                                    <span class="badge bg-success">Final</span>
                                @endif
                            </td>

                            <td>₹ {{ number_format($p->amount,2) }}</td>
                            <td>{{ date('d M Y', strtotime($p->payment_date)) }}</td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="3"class="text-center text-muted">No payments found</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection