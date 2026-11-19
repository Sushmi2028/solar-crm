

<?php $__env->startSection('content'); ?>

<div class="card-box">

    <div class="d-flex justify-content-between mb-3">
        <h5>Quotations</h5>
        <a href="/quotations/create" class="btn btn-primary btn-sm">+ New Quote</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Customer</th>
                <th>System</th>
                <th>Base</th>
                <th>Tax</th>
                <th>Final</th>
                <th>Status</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($q->customer_id); ?></td>
            <td><?php echo e($q->system_size); ?></td>
            <td>₹<?php echo e($q->base_price); ?></td>
            <td>₹<?php echo e($q->tax); ?></td>
            <td><b>₹<?php echo e($q->final_price); ?></b></td>
            <td>
                <span class="badge bg-warning"><?php echo e($q->status); ?></span>
            </td>
            <td class="text-end">
                <a href="/orders/confirm/<?php echo e($q->id); ?>" class="btn btn-success btn-sm">
                    Confirm
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/quotations/index.blade.php ENDPATH**/ ?>