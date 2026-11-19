<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body { font-family: Arial; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

<h2>Leads Report</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($lead->name); ?></td>
            <td><?php echo e($lead->email); ?></td>
            <td><?php echo e($lead->phone); ?></td>
            <td><?php echo e($lead->status); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/reports_pdf.blade.php ENDPATH**/ ?>