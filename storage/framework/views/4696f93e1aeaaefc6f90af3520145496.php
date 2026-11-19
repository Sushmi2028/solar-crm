
<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4">
    <i class="fa fa-file-lines text-primary me-2"></i>Customer Documents
</h4>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Records</h6>
            <h3><?php echo e($documents->count()); ?></h3>
            <i class="fa fa-folder-open"></i>
        </div>
    </div>

    <div class="col-md-6">
        <div class="stat-card card-green">
            <h6>Available Documents</h6>
            <h3><?php echo e($documents->whereNotNull('warranty_document')->count()); ?></h3>
            <i class="fa fa-file-pdf"></i>
        </div>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Warranty & AMC Documents</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Warranty</th>
                        <th>AMC</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($d->customer_name); ?></td>

                    <td>
                        <?php if($d->warranty_document): ?>
                        <a href="<?php echo e(asset('storage/'.$d->warranty_document)); ?>"target="_blank"class="btn btn-success btn-sm">
                            <i class="fa fa-download me-1"></i>Download
                        </a>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($d->amc_document): ?>
                        <a href="<?php echo e(asset('storage/'.$d->amc_document)); ?>"target="_blank" class="btn btn-primary btn-sm">
                            <i class="fa fa-download me-1"></i>Download
                        </a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customer/documents.blade.php ENDPATH**/ ?>