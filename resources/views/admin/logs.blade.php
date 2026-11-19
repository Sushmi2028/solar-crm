@extends('layouts.app')
@section('content')

<h4 class="mb-4 fw-bold">System Audit Logs</h4>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card gradient-blue">
            <h6>Total Activities</h6>
            <h2>{{ count($logs) }}</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="summary-card gradient-green">
            <h6>Recent Activity</h6>
            <h5>{{ count($logs) ? date('d M Y', strtotime($logs->first()->created_at)) : 'N/A' }}</h5>
        </div>
    </div>
</div>

<!-- LOG TABLE -->
<div class="card-box p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Activity History</h5>

        <span class="badge bg-primary">
            {{ count($logs) }} Records
        </span>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Date & Time</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="fw-semibold">{{ $log->user }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ date('d M Y h:i A', strtotime($log->created_at)) }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">
                        No audit logs found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection