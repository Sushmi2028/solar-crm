@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Expense Management</h4>
    <span class="badge bg-danger fs-6">Accountant Module</span>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">
    <!-- ADD EXPENSE CARD -->
    <div class="col-md-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-danger text-white">
                <i class="fa fa-plus-circle me-2"></i>Add New Expense
            </div>

            <div class="card-body">
                <form method="POST" action="/accounts/expenses/store">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-semibold">Expense Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Expense Date</label>
                        <input type="date" name="expense_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Remarks</label>
                        <textarea name="remarks"rows="3" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-danger w-100">
                        <i class="fa fa-save me-1"></i>Save Expense
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- EXPENSE LIST -->
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-dark text-white">
                <i class="fa fa-wallet me-2"></i>Expense Records
            </div>

            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($expenses as $e)
                    <tr>
                        <td>
                            <strong>
                                {{ $e->title }}
                            </strong>
                        </td>

                        <td>
                            <span class="badge bg-danger">
                                ₹ {{ number_format($e->amount,2) }}
                            </span>
                        </td>

                        <td>
                            {{ date('d M Y', strtotime($e->expense_date)) }}
                        </td>

                        <td>
                            {{ $e->remarks ?? '-' }}
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4"
                            class="text-center">
                            No expenses found
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection