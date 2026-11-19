

<?php $__env->startSection('content'); ?>

<div class="card-box">

    <div class="d-flex justify-content-between mb-3">
        <h5>System Settings</h5>
    </div>

    <!-- ✅ SUCCESS MESSAGE -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- ✅ FORM -->
    <form method="POST" action="/admin/settings/save">
        <?php echo csrf_field(); ?>

        <div class="row g-2">

            <!-- 🔽 DROPDOWN -->
            <div class="col-md-5">
                <select name="key" class="form-control" required>
                    <option value="">-- Select Setting --</option>
                    <option value="tax_percent">Tax (%)</option>
                    <option value="tax_type">Tax Type</option>
                    <option value="subsidy_percent">Subsidy (%)</option>
                </select>
            </div>

            <!-- 🔢 VALUE INPUT -->
            <div class="col-md-5">
                <input type="text" name="value" class="form-control"
                       placeholder="Enter value (e.g. 18)" required>
            </div>

            <!-- 🔘 BUTTON -->
            <div class="col-md-2 text-end">
                <button class="btn btn-success btn-sm w-100">Save</button>
            </div>

        </div>
    </form>

    <hr class="my-4">

    <!-- ✅ SETTINGS TABLE -->
    <h6>Saved Settings</h6>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Setting</th>
                <th>Value</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>

                <!-- ✅ FIXED HERE -->
                <td>
                    <?php if($setting->name == 'tax_percent'): ?>
                        Tax (%)
                    <?php elseif($setting->name == 'tax_type'): ?>
                        Tax Type
                    <?php elseif($setting->name == 'subsidy_percent'): ?>
                        Subsidy (%)
                    <?php else: ?>
                        <?php echo e($setting->name); ?>

                    <?php endif; ?>
                </td>

                <td>
                    <?php if($setting->name == 'tax_percent' || $setting->name == 'subsidy_percent'): ?>
                        <?php echo e($setting->value); ?> %
                    <?php else: ?>
                        <?php echo e($setting->value); ?>

                    <?php endif; ?>
                </td>

                <td class="text-end">

                    <!-- DELETE -->
                    <a href="/admin/settings/delete/<?php echo e($setting->id); ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this setting?')">
                       <i class="fa fa-trash"></i>
                    </a>

                </td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3">No settings found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/settings.blade.php ENDPATH**/ ?>