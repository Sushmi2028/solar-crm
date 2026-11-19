
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between mb-4">
    <h4 class="fw-bold">Sales & Revenue Report</h4>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Revenue</h6>
            <h3>₹ <?php echo e(number_format($totalRevenue,2)); ?></h3>
            <i class="fa fa-chart-line"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-green">
            <h6>Paid Revenue</h6>
            <h3>₹ <?php echo e(number_format($paidRevenue,2)); ?></h3>
            <i class="fa fa-money-bill-wave"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-red">
            <h6>Pending Revenue</h6>
            <h3>₹ <?php echo e(number_format($pendingRevenue,2)); ?></h3>
            <i class="fa fa-wallet"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-orange">
            <h6>Total Invoices</h6>
            <h3><?php echo e($totalInvoices); ?></h3>
            <i class="fa fa-file-invoice"></i>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white">
        Revenue Overview
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($s->invoice_no); ?></td>
                <td><?php echo e($s->customer_name); ?></td>
                <td>
                    ₹ <?php echo e(number_format($s->final_amount,2)); ?>

                </td>

                <td>
                    <span class="badge bg-success">
                        <?php echo e($s->status); ?>

                    </span>
                </td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4">No sales records found</td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/accounts/sales-report.blade.php ENDPATH**/ ?>