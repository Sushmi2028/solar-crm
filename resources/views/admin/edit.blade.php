@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            ✏ Edit User
        </h3>

        <a href="/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
            ⬅ Back
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width:700px;">
        <div class="card-body p-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/admin/users/update/{{ $user->id }}">
                @csrf

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">👤 Username</label>
                    <input type="text"
                           name="username"
                           class="form-control form-control-lg rounded-3"
                           value="{{ old('username', $user->username) }}"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">📧 Email</label>
                    <input type="email"
                           name="email"
                           class="form-control form-control-lg rounded-3"
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">📱 Phone</label>
                    <input type="text"
                           name="phone"
                           maxlength="10"
                           class="form-control form-control-lg rounded-3"
                           value="{{ old('phone', $user->phone) }}"
                           oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                           required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">🎯 Role</label>

                    <select name="role" class="form-select form-select-lg rounded-3" required>

                        <option value="Admin" {{ $user->role=='Admin' ? 'selected' : '' }}>
                            👑 Admin
                        </option>

                        <option value="Sales" {{ $user->role=='Sales' ? 'selected' : '' }}>
                            💼 Sales
                        </option>

                        <option value="Engineer" {{ $user->role=='Engineer' ? 'selected' : '' }}>
                            🛠 Engineer
                        </option>

                        <option value="Store / Inventory Manager" {{ $user->role=='Store / Inventory Manager' ? 'selected' : '' }}>
                            📦 Store / Inventory Manager
                        </option>

                        <option value="Accountant" {{ $user->role=='Accountant' ? 'selected' : '' }}>
                            💰 Accountant
                        </option>

                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100">
                        💾 Update User
                    </button>

                    <a href="/admin/users" class="btn btn-outline-danger btn-lg rounded-pill w-100">
                        ❌ Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection