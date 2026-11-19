

<?php $__env->startSection('content'); ?>

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">➕ Add New User</h4>

    <a href="/admin/users" class="btn btn-gradient-secondary">
        ⬅ Back
    </a>
</div>

<!-- ERROR MESSAGES -->
<?php if($errors->any()): ?>
<div class="alert alert-danger shadow-sm">
    <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<!-- 🔥 FORM CARD -->
<div class="card-box" style="max-width: 600px; margin: auto;">

    <form method="POST" action="/admin/users/store">
        <?php echo csrf_field(); ?>
        <!-- NAME -->
        <div class="mb-3">
            <label class="form-label fw-semibold">👤 Username</label>
            <input type="text" name="username"
                   class="form-control premium-input"
                   placeholder="Enter username"
                   required>
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label fw-semibold">📧 Email</label>
            <input type="email" name="email" class="form-control premium-input" placeholder="Enter email" autocomplete="off" required>
        </div>

        <!-- PHONE -->
        <div class="mb-3">
            <label class="form-label fw-semibold">📱 Phone</label>
            <input type="text" name="phone" class="form-control premium-input" placeholder="Enter phone number" value="<?php echo e(old('phone')); ?>"
            maxlength="10" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g,'')"required>        
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label class="form-label fw-semibold">🔒 Password</label>
            <input type="password" name="password" class="form-control premium-input" placeholder="Enter password" autocomplete="off" required>
        </div>

        <!-- ROLE -->
        <div class="mb-4">
            <label class="form-label fw-semibold">🎯 Role</label>
            <select name="role" class="form-select premium-input" required>
                <option value="">Select Role</option>
                <option value="Admin">👑 Admin</option>
                <option value="Sales">💼 Sales</option>
                <option value="Engineer">🛠 Engineer</option>
                <option value="Store / Inventory Manager">📦 Store / Inventory Manager</option>
                <option value="Accountant">💰 Accountant</option>
            </select>
        </div>

        <!-- BUTTONS -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gradient w-100">✅ Create User</button>
            <a href="/admin/users" class="btn btn-gradient w-100">❌ Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/create.blade.php ENDPATH**/ ?>