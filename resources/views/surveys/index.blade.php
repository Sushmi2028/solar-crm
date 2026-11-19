@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-4">Site Survey Management</h4>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card gradient-blue">
            <h6>Total Surveys</h6>
            <h2>{{ count($surveys) }}</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="summary-card gradient-green">
            <h6>Survey Records</h6>
            <h2>{{ count($surveys) }}</h2>
        </div>
    </div>
</div>

<!-- SURVEY TABLE -->
<div class="card-box p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Site Surveys</h5>
        <a href="/surveys/create"class="btn btn-success">
            <i class="fa fa-plus me-1"></i>Add Survey
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Customer</th>
                    <th>Location</th>
                    <th>Roof Type</th>
                    <th>Area Size</th>
                    <th>Remarks</th>
                </tr>
            </thead>

            <tbody>
            @forelse($surveys as $s)
                <tr>
                    <td class="fw-semibold">{{ $s->customer_name }}</td>
                    <td>{{ $s->location }}</td>
                    <td><span class="badge bg-primary">{{ $s->roof_type }}</span></td>
                    <td>{{ $s->area_size }}</td>
                    <td>{{ $s->remarks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"class="text-center py-4">
                        No surveys found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection