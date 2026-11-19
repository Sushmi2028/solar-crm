
<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4">Site Survey Management</h4>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card gradient-blue">
            <h6>Total Surveys</h6>
            <h2><?php echo e(count($surveys)); ?></h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="summary-card gradient-green">
            <h6>Survey Records</h6>
            <h2><?php echo e(count($surveys)); ?></h2>
        </div>
    </div>
</div>

<!-- SURVEY TABLE -->
<div class="card-box p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Site Surveys</h5>
        <a href="/surveys/create"class="btn btn-success">
            <i class="fa fa-plus me-1"></i>Add Survey
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Customer</th>
                    <th>Location</th>
                    <th>Roof Type</th>
                    <th>Area Size</th>
                    <th>Remarks</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="fw-semibold"><?php echo e($s->customer_name); ?></td>
                    <td><?php echo e($s->location); ?></td>
                    <td><span class="badge bg-primary"><?php echo e($s->roof_type); ?></span></td>
                    <td><?php echo e($s->area_size); ?></td>
                    <td><?php echo e($s->remarks); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5"class="text-center py-4">
                        No surveys found
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/surveys/index.blade.php ENDPATH**/ ?>