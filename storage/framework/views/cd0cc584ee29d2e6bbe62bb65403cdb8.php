

<?php $__env->startSection('content'); ?>

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Customer Management</h4>

    <div class="d-flex gap-2">
        <a href="/dashboard" class="btn btn-secondary shadow-sm">
            ← Back
        </a>
    </div>
</div>

<!-- ✅ SUCCESS MESSAGE -->
<?php if(session('success')): ?>
<div class="alert alert-success shadow-sm">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<!-- 🔥 MAIN CARD -->
<div class="card-box">

    <!-- 🔍 SEARCH BAR -->
    <form method="GET" action="/customers" class="row g-2 mb-3">

        <div class="col-md-8">
            <input type="text" name="search" class="form-control shadow-sm"
                   placeholder="🔍 Search by name, email or phone..."
                   value="<?php echo e(request('search')); ?>">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100 shadow-sm">
                🔍 Search
            </button>
        </div>

        <div class="col-md-2">
            <a href="/customers" class="btn btn-warning w-100 shadow-sm">
                🔄 Reset
            </a>
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
                    <th width="260">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>

                <td><?php echo e($cust->id); ?></td>

                <td class="fw-semibold">
                    <?php echo e($cust->name); ?>

                </td>

                <td><?php echo e($cust->email); ?></td>

                <td><?php echo e($cust->phone); ?></td>

                <!-- 🎯 ACTIONS -->
                <td class="d-flex gap-2">

                    <!-- View -->
                    <a href="/customers/view/<?php echo e($cust->id); ?>"
                       class="btn btn-sm btn-outline-info shadow-sm">
                        👁
                    </a>

                    <!-- Edit -->
                    <a href="/customers/edit/<?php echo e($cust->id); ?>"
                       class="btn btn-sm btn-outline-primary shadow-sm">
                        ✏
                    </a>

                    <!-- Delete -->
                    <a href="/customers/delete/<?php echo e($cust->id); ?>"
                       class="btn btn-sm btn-outline-danger shadow-sm"
                       onclick="return confirm('Delete this customer?')">
                        🗑
                    </a>

                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No customers found
                </td>
            </tr>
            <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<!-- 🔥 PAGINATION -->
<div class="mt-3">
    <?php echo e($customers->links('pagination::bootstrap-5')); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customers/index.blade.php ENDPATH**/ ?>