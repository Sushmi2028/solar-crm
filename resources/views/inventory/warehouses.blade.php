@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-warehouse text-primary me-2"></i>Warehouse Management</h4>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-orange">
            <h6>Total Warehouses</h6>
            <h3>{{ $warehouses->count() }}</h3>
            <i class="fa fa-warehouse"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-green">
            <h6>Locations Covered</h6>
            <h3>{{ $warehouses->pluck('location')->unique()->count() }}</h3>
            <i class="fa fa-location-dot"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card card-blue">
            <h6>Storage Centers</h6>
            <h3>{{ $warehouses->count() }}</h3>
            <i class="fa fa-building"></i>
        </div>
    </div>
</div>

<!-- ADD WAREHOUSE -->
<div class="card border-0 shadow-lg mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Add New Warehouse</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="/warehouses/store">
            @csrf
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Warehouse Name</label>
                    <input type="text"name="name"class="form-control"placeholder="Enter warehouse name"required>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter warehouse location"required>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-success w-100"><i class="fa fa-plus me-1"></i>Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- WAREHOUSE TABLE -->
<div class="card border-0 shadow-lg">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Warehouse List</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Warehouse Name</th>
                        <th>Location</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($warehouses as $w)
                <tr>
                    <td><strong>{{ $w->name }}</strong></td>

                    <td>
                        <i class="fa fa-location-dot text-danger me-2"></i>{{ $w->location }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="2" class="text-center text-muted">No warehouses found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection