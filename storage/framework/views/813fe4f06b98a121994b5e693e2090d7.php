
<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4">
    <i class="fa fa-solar-panel text-primary me-2"></i>Order & Installation Status
</h4>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-blue">
            <h6>Total Orders</h6>
            <h3><?php echo e($orders->count()); ?></h3>
            <i class="fa fa-shopping-cart"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-green">
            <h6>Completed Installations</h6>
            <h3><?php echo e($orders->where('handover_status','Completed')->count()); ?></h3>
            <i class="fa fa-check-circle"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card card-orange">
            <h6>Pending Installations</h6>
            <h3><?php echo e($orders->whereNull('handover_status')->count()); ?></h3>
            <i class="fa fa-clock"></i>
        </div>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Order Tracking</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Installation Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($o->customer_name); ?></td>
                    <td>#<?php echo e($o->id); ?></td>
                    <td><span class="badge bg-primary"><?php echo e($o->status); ?></span></td>

                    <td>
                        <?php if($o->handover_status): ?>
                            <span class="badge bg-success"><?php echo e($o->handover_status); ?></span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customer/order-status.blade.php ENDPATH**/ ?>