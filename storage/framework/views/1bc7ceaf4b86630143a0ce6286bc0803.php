
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-box text-primary me-2"></i>Add Product</h4>
    <a href="/inventory" class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <i class="fa fa-check-circle me-2"></i>
        <?php echo e(session('success')); ?>

    <button type="button"class="btn-close"data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">Product Information</h5>
    </div>

    <div class="card-body p-4">
        <form method="POST" action="/inventory/store">
            <?php echo csrf_field(); ?>
            <!-- Product Name -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Category</label>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="Panel">Solar Panel</option>
                    <option value="Inverter">Inverter</option>
                    <option value="Battery">Battery</option>
                    <option value="Structure">Mounting Structure</option>
                </select>
            </div>

            <!-- Warehouse -->
            <div class="mb-3">
                <label>Warehouse</label>
                <select name="warehouse_id" class="form-control" required>
                    <option value="">Select Warehouse</option>
                    <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Product Price (₹)</label>
                <input type="number" name="price" class="form-control" placeholder="Enter product price" required>
            </div>

            <!-- Minimum Stock -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Minimum Stock Level</label>
                <input type="number" name="min_stock" class="form-control" value="5">
                <small class="text-muted">
                    Low stock alerts will trigger below this value.
                </small>
            </div>

            <!-- Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save me-1"></i>Save Product</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/inventory/create.blade.php ENDPATH**/ ?>