
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fa fa-file-invoice-dollar text-primary me-2"></i>Generate Invoice</h4>
    <a href="/billing"class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">Invoice Information</h5>
    </div>

    <div class="card-body p-4">
        <form method="POST" action="/billing/store">
            <?php echo csrf_field(); ?>
            <!-- Customer -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Customer</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">Select Customer</option>

                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Quotation -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Quotation</label>
                <select name="quotation_id" class="form-control"required>
                    <option value="">Select Quotation</option>
                    <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($q->id); ?>">Quotation #<?php echo e($q->id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Total Amount (₹)</label>
                <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Enter Total Amount" required>
            </div>

            <!-- Button -->
            <div class="text-end">
                <button type="submit"class="btn btn-primary px-4">
                    <i class="fa fa-save me-1"></i>Generate Invoice
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/billing/create.blade.php ENDPATH**/ ?>