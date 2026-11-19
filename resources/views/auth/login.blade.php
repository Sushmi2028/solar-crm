<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Solar CRM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    height: 100vh;
    margin: 0;
    background: linear-gradient(135deg, #f6c23e, #f97316);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* 🔥 Glass effect card */
.login-box {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    padding: 30px 25px;
    border-radius: 25px;
    width: 100%;
    max-width: 350px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease;
}

/* Title */
.login-box h4 {
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

/* Floating input */
.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-control {
    height: 42px;
    border-radius: 8px;
    padding-left: 40px;
    font-size: 14px;
}

/* Icons inside input */
.form-group i {
    position: absolute;
    top: 12px;
    left: 12px;
    color: #f97316;
}

/* Button */
.btn-custom {
    background: linear-gradient(135deg, #f97316, #ea580c);
    color: white;
    border-radius: 8px;
    font-size: 14px;
    padding: 10px;
    transition: 0.3s;
}

.btn-custom:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg, #ea580c, #c2410c);
}

/* Link */
.text-link {
    font-size: 13px;
    text-align: center;
    display: block;
    margin-top: 10px;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>

<body>

<div class="login-box">

    <h4>🔐 Login</h4>

    <!-- Error -->
    @if(session('error'))
        <div class="alert alert-danger py-2">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="text-end mb-3">
            <a href="/forgot-password" class="text-decoration-none fw-semibold">Forgot Password?</a>
        </div>

        <!-- Button -->
        <button class="btn btn-custom w-100">Login</button>
    </form>
    
 

    <!-- Register -->
    <a href="/register" class="text-link">Don't have an account? Register</a>

</div>

</body>
</html>