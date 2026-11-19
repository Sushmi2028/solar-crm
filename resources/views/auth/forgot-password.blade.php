@extends('layouts.auth')
@section('content')

<div class="auth-card">
    <h4 class="mb-3 text-center">Forgot Password</h4>
    <form method="POST" action="/forgot-password">
    @csrf
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
        <button class="btn btn-gradient w-100">Reset</button>
    </form>
</div>

@endsection