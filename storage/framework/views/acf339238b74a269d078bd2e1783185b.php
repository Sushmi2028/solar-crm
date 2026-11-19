
<?php $__env->startSection('content'); ?>

<div class="auth-card">
    <h4 class="mb-3 text-center">Forgot Password</h4>
    <form method="POST" action="/forgot-password">
    <?php echo csrf_field(); ?>
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
        <button class="btn btn-gradient w-100">Reset</button>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>