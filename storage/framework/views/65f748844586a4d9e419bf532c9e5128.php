

<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mb-4">📊 Advanced Reports</h4>

<!-- 🔥 FILTER + EXPORT -->
<div class="card-box mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

        <!-- FILTER -->
        <form class="d-flex gap-2">
            <select name="filter" class="form-select">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
            </select>

            <button class="btn btn-gradient">🔍 Apply</button>
        </form>

        <!-- EXPORT BUTTONS -->
        <div class="d-flex gap-2">
                <a href="/admin/export/excel" class="btn btn-success">📥 Download Excel</a>            
                <a href="/admin/export/pdf" class="btn btn-danger">📄 Download PDF</a>
        </div>

    </div>
</div>

<!-- 🔥 STATS -->
<div class="row g-4">

    <div class="col-md-3">
        <div class="dashboard-card card-blue text-center">
            <h6>Total Users</h6>
            <h2><?php echo e($totalUsers); ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-orange text-center">
            <h6>Total Leads</h6>
            <h2><?php echo e($totalLeads); ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-green text-center">
            <h6>Total Customers</h6>
            <h2><?php echo e($totalCustomers); ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-red text-center">
            <h6>Converted</h6>
            <h2><?php echo e($convertedLeads); ?></h2>
        </div>
    </div>

</div>

<!-- 🔥 CHARTS -->
<div class="row mt-4 g-4">

    <!-- PIE -->
    <div class="col-md-6">
        <div class="card-box text-center">
            <h5>Leads Distribution</h5>
            <canvas id="pieChart" style="max-height:250px;"></canvas>
        </div>
    </div>

    <!-- BAR -->
    <div class="col-md-6">
        <div class="card-box text-center">
            <h5>Leads Overview</h5>
            <canvas id="barChart" style="max-height:250px;"></canvas>
        </div>
    </div>

</div>

<!-- 🔥 RECENT USERS -->
<div class="card-box mt-4">
    <h5>Recent Users</h5>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($user->username); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td><span class="badge bg-primary"><?php echo e($user->role); ?></span></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="3" class="text-center">No users found</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- 🔥 CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// PIE CHART
new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['New', 'Contacted', 'Converted'],
        datasets: [{
            data: [<?php echo e($newLeads); ?>, <?php echo e($contactedLeads); ?>, <?php echo e($convertedLeads); ?>],
            backgroundColor: ['#4e73df', '#f6c23e', '#1cc88a']
        }]
    }
});

// BAR CHART
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['New', 'Contacted', 'Converted'],
        datasets: [{
            label: 'Leads',
            data: [<?php echo e($newLeads); ?>, <?php echo e($contactedLeads); ?>, <?php echo e($convertedLeads); ?>],
            backgroundColor: ['#4e73df', '#f6c23e', '#1cc88a']
        }]
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/reports.blade.php ENDPATH**/ ?>