@extends('layouts.auth')

@section('content')

<div class="auth-card">
    <h4 class="mb-3 text-center">Reset Password</h4>

    <form method="POST" action="/reset-password">
    @csrf
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="New Password" required>
        <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password" required>
        <button class="btn btn-gradient w-100">Update Password</button>
    </form>
</div>

@endsection