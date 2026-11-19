

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">✏ Edit Lead</h3>
            <p class="text-muted mb-0">Update lead information</p>
        </div>

        <a href="/leads" class="btn btn-outline-secondary rounded-pill px-4">
            ⬅ Back
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width:750px;">
        <div class="card-header bg-success text-white rounded-top-4 py-3">
            <h5 class="mb-0">Lead Details</h5>
        </div>

        <div class="card-body p-4">

            <!-- Validation Errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/leads/update/<?php echo e($lead->id); ?>">
                <?php echo csrf_field(); ?>

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        👤 Full Name
                    </label>
                    <input type="text"
                           name="name"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('name', $lead->name)); ?>"
                           placeholder="Enter full name"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        📧 Email Address
                    </label>
                    <input type="email"
                           name="email"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('email', $lead->email)); ?>"
                           placeholder="Enter email address">
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        📱 Phone Number
                    </label>
                    <input type="text"
                           name="phone"
                           maxlength="10"
                           class="form-control form-control-lg rounded-3"
                           value="<?php echo e(old('phone', $lead->phone)); ?>"
                           oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                           placeholder="Enter phone number"
                           required>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        📌 Lead Status
                    </label>

                    <select name="status" class="form-select form-select-lg rounded-3">

                        <option value="New"
                            <?php echo e($lead->status == 'New' ? 'selected' : ''); ?>>
                            🟢 New
                        </option>

                        <option value="Contacted"
                            <?php echo e($lead->status == 'Contacted' ? 'selected' : ''); ?>>
                            📞 Contacted
                        </option>

                        <option value="Converted"
                            <?php echo e($lead->status == 'Converted' ? 'selected' : ''); ?>>
                            ✅ Converted
                        </option>

                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3">

                    <button type="submit"
                            class="btn btn-success btn-lg rounded-pill w-100">
                        💾 Update Lead
                    </button>

                    <a href="/leads"
                       class="btn btn-outline-danger btn-lg rounded-pill w-100">
                        ❌ Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/leads/edit.blade.php ENDPATH**/ ?>