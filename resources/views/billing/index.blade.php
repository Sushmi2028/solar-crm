@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Billing Dashboard</h4>
    <a href="/billing/create" class="btn btn-primary"><i class="fa fa-plus me-1"></i>Generate Invoice</a>
</div>

<div class="card-box">
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Tax</th>
                    <th>Subsidy</th>
                    <th>Final Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @forelse($invoices as $i)
            <tr>
                <td>
                    {{ $i->invoice_no }}
                </td>

                <td>
                    {{ $i->customer_name }}
                </td>

                <td>
                    ₹ {{ number_format($i->total_amount, 2) }}
                </td>

                <td class="text-danger">
                    ₹ {{ number_format($i->tax_amount, 2) }}
                </td>

                <td class="text-success">
                    ₹ {{ number_format($i->subsidy_amount, 2) }}
                </td>

                <td class="fw-bold">
                    ₹ {{ number_format($i->final_amount, 2) }}
                </td>

                <td>
                    @if($i->status == 'Paid')
                        <span class="badge bg-success">Paid</span>
                    @elseif($i->status == 'Partial')
                        <span class="badge bg-warning text-dark">Partial</span>
                    @else
                        <span class="badge bg-danger">Pending</span>
                    @endif
                </td>

                <td>
                    <div class="d-flex gap-2">
                        <!-- Payments -->
                        <a href="/payments/{{ $i->id }}"class="btn btn-dark btn-sm"><i class="fa fa-money-bill me-1"></i>Payments</a>
                        <!-- Milestones -->
                        <a href="/milestones/{{ $i->id }}"
                           class="btn btn-info btn-sm">
                            <i class="fa fa-list-check me-1"></i>
                            Milestones
                        </a>
                    </div>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="8" class="text-center">No invoices found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection