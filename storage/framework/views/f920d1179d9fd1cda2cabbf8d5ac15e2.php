

<?php $__env->startSection('content'); ?>

<!-- 🔥 HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Lead Management</h3>
        <small class="text-muted">Manage and track all your leads</small>
    </div>

    <div>
        <a href="/dashboard" class="btn btn-outline-secondary me-2">← Back</a>
        <a href="/leads/create" class="btn btn-success shadow-sm">+ Add Lead</a>
    </div>
</div>

<!-- 📊 KPI CARDS -->
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="dashboard-card card-blue">
            <h5>Total Leads</h5>
            <h2><?php echo e($leads->total()); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card card-orange">
            <h5>New Leads</h5>
            <h2><?php echo e($leads->where('status','New')->count()); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card card-green">
            <h5>Converted</h5>
            <h2><?php echo e($leads->where('status','Converted')->count()); ?></h2>
        </div>
    </div>

</div>

<!-- ✅ SUCCESS MESSAGE -->
<?php if(session('success')): ?>
<div class="alert alert-success shadow-sm">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger shadow-sm">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<!-- 🔍 FILTER CARD -->
<div class="card-box mb-4">

    <form method="GET" action="/leads" class="row g-3">

        <!-- Search -->
        <div class="col-md-4">
            <input type="text" name="search"
                   value="<?php echo e(request('search')); ?>"
                   class="form-control"
                   placeholder="🔍 Search name or phone">
        </div>

        <!-- Status Filter -->
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="New" <?php echo e(request('status')=='New'?'selected':''); ?>>New</option>
                <option value="Contacted" <?php echo e(request('status')=='Contacted'?'selected':''); ?>>Contacted</option>
                <option value="Converted" <?php echo e(request('status')=='Converted'?'selected':''); ?>>Converted</option>
            </select>
        </div>

        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary d-flex align-items-center justify-content-center gap-1 w-100">🔍 <span>Search</span></button>

            <a href="/leads" class="btn btn-primary d-flex align-items-center justify-content-center gap-1 w-100 shadow-sm">🔄 <span>Reset</span>
            </a>       
        </div>
    </form>
</div>

<!-- 📋 TABLE -->
<div class="card-box">

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th width="300">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>

                <td>#<?php echo e($lead->id); ?></td>

                <td class="fw-semibold"><?php echo e($lead->name); ?></td>

                <td><?php echo e($lead->phone); ?></td>

                <!-- STATUS -->
                <td>
                    <?php if($lead->status == 'New'): ?>
                        <span class="badge bg-primary">New</span>
                    <?php elseif($lead->status == 'Contacted'): ?>
                        <span class="badge bg-warning text-dark">Contacted</span>
                    <?php elseif($lead->status == 'Converted'): ?>
                        <span class="badge bg-success">Converted</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><?php echo e($lead->status); ?></span>
                    <?php endif; ?>
                </td>

                <!-- ACTIONS -->
                <td>

                    <a href="/leads/edit/<?php echo e($lead->id); ?>" class="btn btn-sm btn-outline-primary">
                    ✏️ Edit
                    </a>

                    <a href="/leads/delete/<?php echo e($lead->id); ?>" class="btn btn-sm btn-outline-danger"onclick="return confirm('Delete this lead?')">
                    🗑️ Delete
                    </a>

                    <?php if($lead->status != 'Converted'): ?>
                    <a href="/leads/convert/<?php echo e($lead->id); ?>" class="btn btn-sm btn-success">
                    ✔️ Convert
                    </a>
                    <?php else: ?>
                        <span class="badge bg-success">Done</span>
                    <?php endif; ?>

                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No leads found
                </td>
            </tr>
            <?php endif; ?>
            </tbody>

        </table>
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-3">
        <?php echo e($leads->links('vendor.pagination.bootstrap-5')); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/leads/index.blade.php ENDPATH**/ ?>