@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Project Handover</h4>
    <a href="/handover/create" class="btn btn-primary"><i class="fa fa-plus me-1"></i>New Handover</a>
</div>

<div class="card-box">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Customer</th>
                <th>Order</th>
                <th>Commissioning Date</th>
                <th>Training</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>

        @forelse($handovers as $h)
        <tr>
            <!-- CUSTOMER -->
            <td>{{ $h->customer_name }}</td>

            <!-- ORDER -->
            <td>Order #{{ $h->order_number }}</td>

            <!-- DATE -->
            <td>{{ date('d M Y', strtotime($h->commissioning_date)) }}</td>

            <!-- TRAINING -->
            <td>
                @if($h->training_given == 'Yes')
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-danger">Pending</span>
                @endif
            </td>

            <!-- STATUS -->
            <td>
                @if($h->handover_status == 'Completed')
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-warning text-dark">Pending</span>
                @endif
            </td>

            <!-- ACTIONS -->
            <td>
                @if($h->handover_status == 'Pending')
                    <a href="/handover/complete/{{ $h->id }}"class="btn btn-success btn-sm"><i class="fa fa-check me-1"></i>Complete</a>
                @else
                    <span class="badge bg-success">Done</span>
                @endif
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6"class="text-center">No handover records found</td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection