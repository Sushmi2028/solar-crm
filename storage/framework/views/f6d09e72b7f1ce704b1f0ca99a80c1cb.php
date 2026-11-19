
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
        <i class="fa fa-flag-checkered text-primary me-2"></i>Milestone Payments</h4>
    <a href="/billing" class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<?php
    $totalMilestones = $milestones->count();

    $paidMilestones = $milestones
        ->where('status','Paid')
        ->count();

    $pendingMilestones =
        $totalMilestones - $paidMilestones;

    $progress = $totalMilestones > 0
        ? ($paidMilestones / $totalMilestones) * 100
        : 0;
?>

<!-- SUMMARY CARDS -->
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="stat-card card-blue">
            <h6>Total Milestones</h6>
            <h3><?php echo e($totalMilestones); ?></h3>
            <i class="fa fa-list-check"></i>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card card-green">
            <h6>Completed</h6>
            <h3><?php echo e($paidMilestones); ?></h3>
            <i class="fa fa-circle-check"></i>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card card-orange">
            <h6>Pending</h6>
            <h3><?php echo e($pendingMilestones); ?></h3>
            <i class="fa fa-clock"></i>
        </div>
    </div>
</div>

<!-- PROGRESS SECTION -->
<div class="card border-0 shadow-lg mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Milestone Completion Progress</h5>
    </div>

    <div class="card-body">
        <div class="progress"style="height:30px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 role="progressbar"
                 style="width: <?php echo e($progress); ?>%;">
                <?php echo e(number_format($progress,0)); ?>%
            </div>
        </div>

        <div class="text-muted mt-3">
            <?php echo e($paidMilestones); ?>

            out of
            <?php echo e($totalMilestones); ?>

            milestones completed
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="card border-0 shadow-lg">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Milestone Details</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Milestone</th>
                        <th>Percentage</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td>
                        <strong>
                            <?php echo e($m->milestone_name); ?>

                        </strong>
                    </td>

                    <td><?php echo e($m->percentage); ?>%</td>
                    <td>₹ <?php echo e(number_format($m->amount,2)); ?></td>

                    <td>
                        <?php if($m->status == 'Paid'): ?>
                            <span class="badge bg-success">Paid</span>
                        <?php elseif($m->status == 'Partial'): ?>
                            <span class="badge bg-info">Partial</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5"class="text-center text-muted">
                        No milestone records found
                    </td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/billing/milestones.blade.php ENDPATH**/ ?>