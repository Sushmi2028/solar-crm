@extends('layouts.app')

@section('content')

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Lead Management</h3>
        <small class="text-muted">Manage and track all your leads</small>
    </div>

    <div>
        <a href="/dashboard" class="btn btn-outline-secondary me-2">← Back</a>
        <a href="/leads/create" class="btn btn-success shadow-sm">+ Add Lead</a>
    </div>
</div>

<!-- 📊 KPI CARDS -->
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="dashboard-card card-blue">
            <h5>Total Leads</h5>
            <h2>{{ $leads->total() }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card card-orange">
            <h5>New Leads</h5>
            <h2>{{ $leads->where('status','New')->count() }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card card-green">
            <h5>Converted</h5>
            <h2>{{ $leads->where('status','Converted')->count() }}</h2>
        </div>
    </div>

</div>

<!-- ✅ SUCCESS MESSAGE -->
@if(session('success'))
<div class="alert alert-success shadow-sm">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger shadow-sm">
    {{ session('error') }}
</div>
@endif

<!-- 🔍 FILTER CARD -->
<div class="card-box mb-4">

    <form method="GET" action="/leads" class="row g-3">

        <!-- Search -->
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="🔍 Search name or phone">
        </div>

        <!-- Status Filter -->
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="New" {{ request('status')=='New'?'selected':'' }}>New</option>
                <option value="Contacted" {{ request('status')=='Contacted'?'selected':'' }}>Contacted</option>
                <option value="Converted" {{ request('status')=='Converted'?'selected':'' }}>Converted</option>
            </select>
        </div>

        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary d-flex align-items-center justify-content-center gap-1 w-100">🔍 <span>Search</span></button>

            <a href="/leads" class="btn btn-primary d-flex align-items-center justify-content-center gap-1 w-100 shadow-sm">🔄 <span>Reset</span>
            </a>       
        </div>
    </form>
</div>

<!-- 📋 TABLE -->
<div class="card-box">

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th width="300">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($leads as $lead)
            <tr>

                <td>#{{ $lead->id }}</td>

                <td class="fw-semibold">{{ $lead->name }}</td>

                <td>{{ $lead->phone }}</td>

                <!-- STATUS -->
                <td>
                    @if($lead->status == 'New')
                        <span class="badge bg-primary">New</span>
                    @elseif($lead->status == 'Contacted')
                        <span class="badge bg-warning text-dark">Contacted</span>
                    @elseif($lead->status == 'Converted')
                        <span class="badge bg-success">Converted</span>
                    @else
                        <span class="badge bg-secondary">{{ $lead->status }}</span>
                    @endif
                </td>

                <!-- ACTIONS -->
                <td>

                    <a href="/leads/edit/{{ $lead->id }}" class="btn btn-sm btn-outline-primary">
                    ✏️ Edit
                    </a>

                    <a href="/leads/delete/{{ $lead->id }}" class="btn btn-sm btn-outline-danger"onclick="return confirm('Delete this lead?')">
                    🗑️ Delete
                    </a>

                    @if($lead->status != 'Converted')
                    <a href="/leads/convert/{{ $lead->id }}" class="btn btn-sm btn-success">
                    ✔️ Convert
                    </a>
                    @else
                        <span class="badge bg-success">Done</span>
                    @endif

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No leads found
                </td>
            </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-3">
        {{ $leads->links('vendor.pagination.bootstrap-5') }}
    </div>

</div>

@endsection