@extends('layouts.app')

@section('content')

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Customer Management</h4>

    <div class="d-flex gap-2">
        <a href="/dashboard" class="btn btn-secondary shadow-sm">
            ← Back
        </a>
    </div>
</div>

<!-- ✅ SUCCESS MESSAGE -->
@if(session('success'))
<div class="alert alert-success shadow-sm">
    {{ session('success') }}
</div>
@endif

<!-- 🔥 MAIN CARD -->
<div class="card-box">

    <!-- 🔍 SEARCH BAR -->
    <form method="GET" action="/customers" class="row g-2 mb-3">

        <div class="col-md-8">
            <input type="text" name="search" class="form-control shadow-sm"
                   placeholder="🔍 Search by name, email or phone..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100 shadow-sm">
                🔍 Search
            </button>
        </div>

        <div class="col-md-2">
            <a href="/customers" class="btn btn-warning w-100 shadow-sm">
                🔄 Reset
            </a>
        </div>

    </form>

    <!-- 📊 TABLE -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="260">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($customers as $cust)
            <tr>

                <td>{{ $cust->id }}</td>

                <td class="fw-semibold">
                    {{ $cust->name }}
                </td>

                <td>{{ $cust->email }}</td>

                <td>{{ $cust->phone }}</td>

                <!-- 🎯 ACTIONS -->
                <td class="d-flex gap-2">

                    <!-- View -->
                    <a href="/customers/view/{{ $cust->id }}"
                       class="btn btn-sm btn-outline-info shadow-sm">
                        👁
                    </a>

                    <!-- Edit -->
                    <a href="/customers/edit/{{ $cust->id }}"
                       class="btn btn-sm btn-outline-primary shadow-sm">
                        ✏
                    </a>

                    <!-- Delete -->
                    <a href="/customers/delete/{{ $cust->id }}"
                       class="btn btn-sm btn-outline-danger shadow-sm"
                       onclick="return confirm('Delete this customer?')">
                        🗑
                    </a>

                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No customers found
                </td>
            </tr>
            @endforelse
            </tbody>

        </table>
    </div>

</div>

<!-- 🔥 PAGINATION -->
<div class="mt-3">
    {{ $customers->links('pagination::bootstrap-5') }}
</div>

@endsection