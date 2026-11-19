
<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4">Financial Dashboard</h4>
<div class="row mb-5">
    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-blue">
            <h6>Total Sales</h6>
            <h3>₹ <?php echo e(number_format($totalSales,2)); ?></h3>
            <i class="fa fa-chart-line"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-green">
            <h6>Total Payments</h6>
            <h3>₹ <?php echo e(number_format($totalPayments,2)); ?></h3>
            <i class="fa fa-money-bill-wave"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-red">
            <h6>Total Expenses</h6>
            <h3>₹ <?php echo e(number_format($totalExpenses,2)); ?></h3>
            <i class="fa fa-wallet"></i>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
        <div class="stat-card card-orange">
            <h6>Net Profit</h6>
            <h3>₹ <?php echo e(number_format($profit,2)); ?></h3>
            <i class="fa fa-coins"></i>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-dark text-white">
        Recent Payments
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e($p->invoice_id); ?></td>
                <td>₹ <?php echo e(number_format($p->amount,2)); ?></td>
                <td><?php echo e($p->payment_date); ?></td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3">No payment records found</td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/accounts/index.blade.php ENDPATH**/ ?>