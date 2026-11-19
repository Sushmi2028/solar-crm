
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Billing Dashboard</h4>
    <a href="/billing/create" class="btn btn-primary"><i class="fa fa-plus me-1"></i>Generate Invoice</a>
</div>

<div class="card-box">
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Tax</th>
                    <th>Subsidy</th>
                    <th>Final Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php echo e($i->invoice_no); ?>

                </td>

                <td>
                    <?php echo e($i->customer_name); ?>

                </td>

                <td>
                    ₹ <?php echo e(number_format($i->total_amount, 2)); ?>

                </td>

                <td class="text-danger">
                    ₹ <?php echo e(number_format($i->tax_amount, 2)); ?>

                </td>

                <td class="text-success">
                    ₹ <?php echo e(number_format($i->subsidy_amount, 2)); ?>

                </td>

                <td class="fw-bold">
                    ₹ <?php echo e(number_format($i->final_amount, 2)); ?>

                </td>

                <td>
                    <?php if($i->status == 'Paid'): ?>
                        <span class="badge bg-success">Paid</span>
                    <?php elseif($i->status == 'Partial'): ?>
                        <span class="badge bg-warning text-dark">Partial</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Pending</span>
                    <?php endif; ?>
                </td>

                <td>
                    <div class="d-flex gap-2">
                        <!-- Payments -->
                        <a href="/payments/<?php echo e($i->id); ?>"class="btn btn-dark btn-sm"><i class="fa fa-money-bill me-1"></i>Payments</a>
                        <!-- Milestones -->
                        <a href="/milestones/<?php echo e($i->id); ?>"
                           class="btn btn-info btn-sm">
                            <i class="fa fa-list-check me-1"></i>
                            Milestones
                        </a>
                    </div>
                </td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="text-center">No invoices found</td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/billing/index.blade.php ENDPATH**/ ?>