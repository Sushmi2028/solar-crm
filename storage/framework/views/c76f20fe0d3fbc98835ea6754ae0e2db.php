

<?php $__env->startSection('content'); ?>

<h4 class="mb-4 fw-bold">Dashboard</h4>

<!-- 🔥 STAT CARDS -->
<div class="row g-4">

    <div class="col-md-3">
        <div class="dashboard-card card-orange">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>Total Leads</h5>
                    <h2><?php echo e($totalLeads ?? 0); ?></h2>
                </div>
                <i class="fa fa-chart-line fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-green">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>Total Customers</h5>
                    <h2><?php echo e($totalCustomers ?? 0); ?></h2>
                </div>
                <i class="fa fa-users fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-blue">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>New Leads</h5>
                    <h2><?php echo e($newLeads ?? 0); ?></h2>
                </div>
                <i class="fa fa-user-plus fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card card-red">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>Converted</h5>
                    <h2><?php echo e($convertedLeads ?? 0); ?></h2>
                </div>
                <i class="fa fa-check-circle fa-2x"></i>
            </div>
        </div>
    </div>
    

</div>

<!-- 🔥 CHART -->
<div class="card-box mt-4 text-center">
    <h5 class="mb-3">Lead Status Overview</h5>

    <div style="max-width: 260px; margin: auto;">
        <canvas id="leadChart"></canvas>
    </div>
</div>

<!-- 🔥 TABLES -->
<div class="row mt-4 g-4">

    <!-- Recent Leads -->
    <div class="col-md-6">
        <div class="card-box">
            <h5>Recent Leads</h5>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($lead->name); ?></td>
                    <td><?php echo e($lead->phone); ?></td>
                    <td>
                        <span class="badge bg-success">
                            <?php echo e($lead->status); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3">No leads found</td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Recent Customers -->
    <div class="col-md-6">
        <div class="card-box">
            <h5>Recent Customers</h5>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($cust->name); ?></td>
                    <td><?php echo e($cust->phone); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="2">No customers found</td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- 🔥 SINGLE CLEAN CHART SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const dataValues = [
    <?php echo e($newLeads ?? 0); ?>,
    <?php echo e($contactedLeads ?? 0); ?>,
    <?php echo e($convertedLeads ?? 0); ?>

];

const total = dataValues.reduce((a, b) => a + b, 0);

// 🔥 Better Label Plugin (clean + visible)
const labelPlugin = {
    id: 'labelPlugin',
    afterDraw(chart) {
        const { ctx } = chart;

        chart.data.datasets.forEach((dataset, i) => {
            chart.getDatasetMeta(i).data.forEach((datapoint, index) => {

                const value = dataset.data[index];

                // Show even if 0
                const percentage = total === 0 
                    ? "0%" 
                    : ((value / total) * 100).toFixed(0) + "%";

                const { x, y } = datapoint.tooltipPosition();

                ctx.fillStyle = "#fff";
                ctx.font = "bold 14px sans-serif";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";

                ctx.fillText(percentage, x, y);
            });
        });
    }
};

new Chart(document.getElementById('leadChart'), {
    type: 'doughnut',

    data: {
        labels: ['🟦 New', '🟨 Contacted', '🟩 Converted'],
        datasets: [{
            data: dataValues,
            backgroundColor: [
                '#4e73df',
                '#f6c23e',
                '#1cc88a'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },

    options: {
        responsive: true,
        cutout: '65%', // 🔥 donut thickness

        animation: false,
        hover: { mode: null }, // ❌ disable hover

        plugins: {
            tooltip: {
                enabled: false // ❌ no tooltip
            },
            legend: {
                position: 'bottom',
                labels: {
                    font: {
                        size: 13,
                        weight: 'bold'
                    }
                }
            }
        }
    },

    plugins: [labelPlugin]
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/dashboard.blade.php ENDPATH**/ ?>