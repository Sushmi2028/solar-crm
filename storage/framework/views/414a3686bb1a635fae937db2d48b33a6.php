<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | Solar CRM</title>

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

/* 🔥 Same glass UI */
.register-box {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    padding: 30px 25px;
    border-radius: 15px;
    width: 100%;
    max-width: 320px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease;
}

/* Title */
.register-box h4 {
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

/* Inputs */
.form-group {
    position: relative;
    margin-bottom: 15px;
}

.form-control {
    height: 42px;
    border-radius: 8px;
    padding-left: 40px;
    font-size: 14px;
}

/* Icons */
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
<div class="register-box">
    <h4>📝 Register</h4>
    <!-- Errors -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger py-2">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/register">
        <?php echo csrf_field(); ?>

        <!-- Username -->
        <div class="form-group">
            <i class="fa fa-user"></i>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <i class="fa fa-phone"></i>
            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <!-- Role -->
        <div class="form-group">
            <i class="fa fa-user-tag"></i>
            <select name="role" class="form-control" required>
                <option value="">-- Select Role --</option>
                <option value="Admin">Admin</option>
                <option value="Sales Executive">Sales Executive</option>
                <option value="Store / Inventory Manager">Store / Inventory Manager</option>
                <option value="Installation Engineer">Installation Engineer</option>
                <option value="Accountant">Accountant</option>
                <option value="Customer">Customer</option>
            </select>
        </div>

        <!-- Button -->
        <button class="btn btn-custom w-100">Register</button>
    </form>

    <!-- Login -->
    <a href="/login" class="text-link">
        Already have an account? Login
    </a>

</div>

</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/auth/register.blade.php ENDPATH**/ ?>