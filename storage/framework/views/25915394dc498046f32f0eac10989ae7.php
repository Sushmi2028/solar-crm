<h3>Inventory Report</h3>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Min</th>
    </tr>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($p->name); ?></td>
        <td><?php echo e($p->category); ?></td>
        <td><?php echo e($p->stock); ?></td>
        <td><?php echo e($p->min_stock); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/inventory/pdf.blade.php ENDPATH**/ ?>