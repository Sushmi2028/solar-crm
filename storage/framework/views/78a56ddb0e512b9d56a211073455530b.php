
<?php $__env->startSection('content'); ?>

<!-- HEADER -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">Site Survey</h4>
            <p class="mb-0">Record customer site inspection details</p>
        </div>

        <a href="/surveys"class="btn btn-light">
            <i class="fa fa-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<!-- FORM CARD -->
<div class="card-box p-4">
    <h5 class="fw-bold mb-4">
        <i class="fa fa-map-location-dot me-2"></i>Add Site Survey
    </h5>

    <form method="POST"action="/surveys/store">
        <?php echo csrf_field(); ?>
        <!-- CUSTOMER -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Customer</label>
            <select name="customer_id"class="form-control"required>
                <option value="">Select Customer</option>
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- LOCATION -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Location</label>
            <input type="text"name="location"class="form-control"placeholder="Enter survey location"required>
        </div>

        <!-- ROOF TYPE -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Roof Type</label>
            <input type="text"name="roof_type"class="form-control"placeholder="Example: RCC, Metal Sheet, Tile"required>
        </div>

        <!-- AREA SIZE -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Area Size</label>
            <input type="text"name="area_size"class="form-control"placeholder="Example: 1200 sq.ft"required>
        </div>

        <!-- REMARKS -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Remarks</label>
            <textarea name="remarks" rows="4" class="form-control" placeholder="Enter survey observations or notes"></textarea>
        </div>

        <!-- BUTTON -->
        <div class="text-end">
            <button class="btn btn-success btn-save">
                <i class="fa fa-save me-1"></i>Save Survey
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/surveys/create.blade.php ENDPATH**/ ?>