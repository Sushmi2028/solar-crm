
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Project Handover</h4>
    <a href="/handover/create" class="btn btn-primary"><i class="fa fa-plus me-1"></i>New Handover</a>
</div>

<div class="card-box">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Customer</th>
                <th>Order</th>
                <th>Commissioning Date</th>
                <th>Training</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $handovers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <!-- CUSTOMER -->
            <td><?php echo e($h->customer_name); ?></td>

            <!-- ORDER -->
            <td>Order #<?php echo e($h->order_number); ?></td>

            <!-- DATE -->
            <td><?php echo e(date('d M Y', strtotime($h->commissioning_date))); ?></td>

            <!-- TRAINING -->
            <td>
                <?php if($h->training_given == 'Yes'): ?>
                    <span class="badge bg-success">Completed</span>
                <?php else: ?>
                    <span class="badge bg-danger">Pending</span>
                <?php endif; ?>
            </td>

            <!-- STATUS -->
            <td>
                <?php if($h->handover_status == 'Completed'): ?>
                    <span class="badge bg-success">Completed</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php endif; ?>
            </td>

            <!-- ACTIONS -->
            <td>
                <?php if($h->handover_status == 'Pending'): ?>
                    <a href="/handover/complete/<?php echo e($h->id); ?>"class="btn btn-success btn-sm"><i class="fa fa-check me-1"></i>Complete</a>
                <?php else: ?>
                    <span class="badge bg-success">Done</span>
                <?php endif; ?>
            </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6"class="text-center">No handover records found</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/handover/index.blade.php ENDPATH**/ ?>