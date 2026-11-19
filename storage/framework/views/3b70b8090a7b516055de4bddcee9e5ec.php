

<?php $__env->startSection('content'); ?>

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

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/admin/users/update/<?php echo e($user->id); ?>">
                <?php echo csrf_field(); ?>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">👤 Username</label>
                    <input type="text"
                           name="username"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('username', $user->username)); ?>"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">📧 Email</label>
                    <input type="email"
                           name="email"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('email', $user->email)); ?>"
                           required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">📱 Phone</label>
                    <input type="text"
                           name="phone"
                           maxlength="10"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('phone', $user->phone)); ?>"
                           oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                           required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">🎯 Role</label>

                    <select name="role" class="form-select form-select-lg rounded-3" required>

                        <option value="Admin" <?php echo e($user->role=='Admin' ? 'selected' : ''); ?>>
                            👑 Admin
                        </option>

                        <option value="Sales" <?php echo e($user->role=='Sales' ? 'selected' : ''); ?>>
                            💼 Sales
                        </option>

                        <option value="Engineer" <?php echo e($user->role=='Engineer' ? 'selected' : ''); ?>>
                            🛠 Engineer
                        </option>

                        <option value="Store / Inventory Manager" <?php echo e($user->role=='Store / Inventory Manager' ? 'selected' : ''); ?>>
                            📦 Store / Inventory Manager
                        </option>

                        <option value="Accountant" <?php echo e($user->role=='Accountant' ? 'selected' : ''); ?>>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/edit.blade.php ENDPATH**/ ?>