

<?php $__env->startSection('content'); ?>

<div class="auth-card">
    <h4 class="mb-3 text-center">Reset Password</h4>

    <form method="POST" action="/reset-password">
    <?php echo csrf_field(); ?>
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="New Password" required>
        <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password" required>
        <button class="btn btn-gradient w-100">Update Password</button>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>