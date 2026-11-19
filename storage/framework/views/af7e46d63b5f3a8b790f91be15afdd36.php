
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Expense Management</h4>
    <span class="badge bg-danger fs-6">Accountant Module</span>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="row">
    <!-- ADD EXPENSE CARD -->
    <div class="col-md-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-danger text-white">
                <i class="fa fa-plus-circle me-2"></i>Add New Expense
            </div>

            <div class="card-body">
                <form method="POST" action="/accounts/expenses/store">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="fw-semibold">Expense Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Expense Date</label>
                        <input type="date" name="expense_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Remarks</label>
                        <textarea name="remarks"rows="3" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-danger w-100">
                        <i class="fa fa-save me-1"></i>Save Expense
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- EXPENSE LIST -->
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-dark text-white">
                <i class="fa fa-wallet me-2"></i>Expense Records
            </div>

            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <strong>
                                <?php echo e($e->title); ?>

                            </strong>
                        </td>

                        <td>
                            <span class="badge bg-danger">
                                ₹ <?php echo e(number_format($e->amount,2)); ?>

                            </span>
                        </td>

                        <td>
                            <?php echo e(date('d M Y', strtotime($e->expense_date))); ?>

                        </td>

                        <td>
                            <?php echo e($e->remarks ?? '-'); ?>

                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4"
                            class="text-center">
                            No expenses found
                        </td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/accounts/expenses.blade.php ENDPATH**/ ?>