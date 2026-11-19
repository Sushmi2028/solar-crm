
<?php $__env->startSection('content'); ?>

<h4 class="mb-4 fw-bold">System Audit Logs</h4>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card gradient-blue">
            <h6>Total Activities</h6>
            <h2><?php echo e(count($logs)); ?></h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="summary-card gradient-green">
            <h6>Recent Activity</h6>
            <h5><?php echo e(count($logs) ? date('d M Y', strtotime($logs->first()->created_at)) : 'N/A'); ?></h5>
        </div>
    </div>
</div>

<!-- LOG TABLE -->
<div class="card-box p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Activity History</h5>

        <span class="badge bg-primary">
            <?php echo e(count($logs)); ?> Records
        </span>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Date & Time</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="fw-semibold"><?php echo e($log->user); ?></td>
                    <td><?php echo e($log->action); ?></td>
                    <td><?php echo e(date('d M Y h:i A', strtotime($log->created_at))); ?></td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="text-center py-4">
                        No audit logs found
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/logs.blade.php ENDPATH**/ ?>