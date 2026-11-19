
<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4"><i class="fa fa-credit-card text-primary me-2"></i>Payment History</h4>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-blue">
            <h6>Total Payments</h6>
            <h3><?php echo e($payments->count()); ?></h3>
            <i class="fa fa-wallet"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-green">
            <h6>Total Amount</h6>
            <h3>₹<?php echo e(number_format($payments->sum('amount'))); ?></h3>
            <i class="fa fa-indian-rupee-sign"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-orange">
            <h6>Latest Payments</h6>
            <h3><?php echo e($payments->take(5)->count()); ?></h3>
            <i class="fa fa-clock"></i>
        </div>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Payment Transactions</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Payment Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($p->customer_name); ?></td>
                    <td><span class="badge bg-primary"><?php echo e($p->payment_type); ?></span></td>
                    <td class="fw-bold text-success">₹ <?php echo e(number_format($p->amount,2)); ?></td>
                    <td><?php echo e($p->payment_date); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customer/payments.blade.php ENDPATH**/ ?>