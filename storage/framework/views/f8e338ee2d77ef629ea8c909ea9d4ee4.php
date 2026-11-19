

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">⚡ Installation Dashboard</h2>
            <small class="text-muted">Track all solar installations in real-time</small>
        </div>
    </div>

<!-- SUMMARY CARDS (PREMIUM STYLE) -->
<div class="row g-4 mb-4">

    <!-- TOTAL -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-white"
             style="background: linear-gradient(135deg, #4f46e5, #6366f1);">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75">Total Installations</h6>
                        <h2 class="fw-bold mb-0"><?php echo e($installations->count()); ?></h2>
                    </div>
                    <i class="fa fa-bolt fa-2x opacity-50"></i>
                </div>
            </div>

        </div>
    </div>

    <!-- SCHEDULED -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-white"
             style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75">Scheduled</h6>
                        <h2 class="fw-bold mb-0">
                            <?php echo e($installations->where('status','Scheduled')->count()); ?>

                        </h2>
                    </div>
                    <i class="fa fa-calendar fa-2x opacity-50"></i>
                </div>
            </div>

        </div>
    </div>

    <!-- IN PROGRESS -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-white"
             style="background: linear-gradient(135deg, #2563eb, #60a5fa);">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75">In Progress</h6>
                        <h2 class="fw-bold mb-0">
                            <?php echo e($installations->where('status','In Progress')->count()); ?>

                        </h2>
                    </div>
                    <i class="fa fa-cogs fa-2x opacity-50"></i>
                </div>
            </div>

        </div>
    </div>

    <!-- COMPLETED -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-white"
             style="background: linear-gradient(135deg, #16a34a, #4ade80);">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75">Completed</h6>
                        <h2 class="fw-bold mb-0">
                            <?php echo e($installations->where('status','Completed')->count()); ?>

                        </h2>
                    </div>
                    <i class="fa fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- TABLE CARD -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Installation List</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>Customer</th>
                            <th>Engineer</th>
                            <th>Schedule</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php $__currentLoopData = $installations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <!-- CUSTOMER -->
                        <td class="fw-semibold">
                            <?php echo e($i->customer_name); ?>

                        </td>

                        <!-- ENGINEER -->
                        <td>
                            <span class="badge bg-light text-dark border">
                                <?php echo e($i->engineer_name ?? 'Not Assigned'); ?>

                            </span>
                        </td>

                        <!-- DATE -->
                        <td>
                            <i class="fa fa-calendar text-muted me-1"></i>
                            <?php echo e($i->schedule_date); ?>

                        </td>

                        <!-- PROGRESS -->
                        <td style="width:260px;">

                            <div class="progress mb-2" style="height:8px;">
                                <div class="progress-bar bg-success"
                                     style="width: <?php echo e($i->progress); ?>%">
                                </div>
                            </div>

                            <form method="POST" action="/installations/update-progress"
                                  class="d-flex gap-2">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="installation_id" value="<?php echo e($i->id); ?>">

                                <input type="number"
                                       name="progress"
                                       value="<?php echo e($i->progress); ?>"
                                       min="0"
                                       max="100"
                                       class="form-control form-control-sm">

                                <button class="btn btn-outline-primary btn-sm">
                                    Update
                                </button>
                            </form>

                        </td>

                        <!-- STATUS -->
                        <td>
                            <span class="badge fs-6 px-3 py-2
                                <?php if($i->status=='Completed'): ?> bg-success
                                <?php elseif($i->status=='In Progress'): ?> bg-primary
                                <?php else: ?> bg-warning text-dark
                                <?php endif; ?>">
                                <?php echo e($i->status); ?>

                            </span>
                        </td>

                        <!-- ACTION -->
                        <td class="text-center">

                            <form method="POST" action="/installations/update-progress">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="installation_id" value="<?php echo e($i->id); ?>">
                                <input type="hidden" name="progress" value="100">

                                <button class="btn btn-success btn-sm shadow-sm">✔ Complete</button>
                            </form>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/installations/index.blade.php ENDPATH**/ ?>