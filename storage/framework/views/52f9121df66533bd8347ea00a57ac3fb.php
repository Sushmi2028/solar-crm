

<?php $__env->startSection('content'); ?>

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
<?php if(session('success')): ?>
<div class="alert alert-success shadow-sm">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<!-- 🔥 MAIN CARD -->
<div class="card-box">

    <!-- 🔍 SEARCH + FILTER -->
    <form class="row g-2 mb-3">

        <div class="col-md-5">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                class="form-control shadow-sm"
                placeholder="🔍 Search name, email, phone...">
        </div>

        <div class="col-md-3">
            <select name="role" class="form-select shadow-sm">
                <option value="">All Roles</option>
                <option value="Admin" <?php echo e(request('role')=='Admin'?'selected':''); ?>>Admin</option>
                <option value="Sales" <?php echo e(request('role')=='Sales'?'selected':''); ?>>Sales</option>
                <option value="Engineer" <?php echo e(request('role')=='Engineer'?'selected':''); ?>>Engineer</option>
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
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>

                <td><?php echo e($user->id); ?></td>

                <td class="fw-semibold">
                    <?php echo e($user->username); ?>

                </td>

                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->phone); ?></td>

                <!-- ROLE BADGE -->
                <td>
                    <td>
                        <?php if($user->role == 'Admin'): ?>
                            <span class="badge bg-danger">👑 Admin</span>

                        <?php elseif($user->role == 'Sales'): ?>
                            <span class="badge bg-success">💼 Sales</span>

                        <?php elseif($user->role == 'Engineer'): ?>
                            <span class="badge bg-warning text-dark">🛠 Engineer</span>

                        <?php elseif($user->role == 'Store / Inventory Manager'): ?>
                            <span class="badge bg-primary">📦 Store / Inventory Manager</span>

                        <?php elseif($user->role == 'Accountant'): ?>
                            <span class="badge bg-info text-dark">💰 Accountant</span>

                        <?php else: ?>
                            <span class="badge bg-secondary"><?php echo e($user->role); ?></span>
                        <?php endif; ?>
                </td>

                <!-- ACTIONS -->
                <td>

                    <a href="/admin/users/edit/<?php echo e($user->id); ?>"
                       class="btn btn-sm btn-outline-primary">
                        ✏
                    </a>

                    <a href="/admin/users/delete/<?php echo e($user->id); ?>"
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Delete this user?')">
                        🗑
                    </a>

                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No users found
                </td>
            </tr>
            <?php endif; ?>
            </tbody>

        </table>
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-3 d-flex justify-content-center">
        <?php echo e($users->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/users.blade.php ENDPATH**/ ?>