@extends('layouts.app')

@section('content')

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">👤 User Management</h4>

    <div class="d-flex gap-2">
        <a href="/dashboard" class="btn btn-gradient-secondary">⬅ Back</a>



        <a href="/admin/users/create" class="btn btn-gradient">
            ➕ Add User
        </a>
    </div>
</div>

<!-- SUCCESS -->
@if(session('success'))
<div class="alert alert-success shadow-sm">
    {{ session('success') }}
</div>
@endif

<!-- 🔥 MAIN CARD -->
<div class="card-box">

    <!-- 🔍 SEARCH + FILTER -->
    <form class="row g-2 mb-3">

        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control shadow-sm"
                placeholder="🔍 Search name, email, phone...">
        </div>

        <div class="col-md-3">
            <select name="role" class="form-select shadow-sm">
                <option value="">All Roles</option>
                <option value="Admin" {{ request('role')=='Admin'?'selected':'' }}>Admin</option>
                <option value="Sales" {{ request('role')=='Sales'?'selected':'' }}>Sales</option>
                <option value="Engineer" {{ request('role')=='Engineer'?'selected':'' }}>Engineer</option>
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-gradient w-100">🔍 Search</button>

            <a href="/admin/users" class="btn btn-gradient w-100">🔄 Reset</a>
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
                    <th>Role</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($users as $user)
            <tr>

                <td>{{ $user->id }}</td>

                <td class="fw-semibold">
                    {{ $user->username }}
                </td>

                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>

                <!-- ROLE BADGE -->
                <td>
                    <td>
                        @if($user->role == 'Admin')
                            <span class="badge bg-danger">👑 Admin</span>

                        @elseif($user->role == 'Sales')
                            <span class="badge bg-success">💼 Sales</span>

                        @elseif($user->role == 'Engineer')
                            <span class="badge bg-warning text-dark">🛠 Engineer</span>

                        @elseif($user->role == 'Store / Inventory Manager')
                            <span class="badge bg-primary">📦 Store / Inventory Manager</span>

                        @elseif($user->role == 'Accountant')
                            <span class="badge bg-info text-dark">💰 Accountant</span>

                        @else
                            <span class="badge bg-secondary">{{ $user->role }}</span>
                        @endif
                </td>

                <!-- ACTIONS -->
                <td>

                    <a href="/admin/users/edit/{{ $user->id }}"
                       class="btn btn-sm btn-outline-primary">
                        ✏
                    </a>

                    <a href="/admin/users/delete/{{ $user->id }}"
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Delete this user?')">
                        🗑
                    </a>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No users found
                </td>
            </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $users->links() }}
    </div>

</div>

@endsection