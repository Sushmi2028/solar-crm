<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Lead | Solar CRM</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e8f5e9, #f4fdf7);
}

/* Center card */
.form-container {
    max-width: 500px;
    margin: 60px auto;
}

/* Card UI */
.card-box {
    border-radius: 15px;
    padding: 30px;
    background: white;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* Header */
.page-header {
    text-align: center;
    margin-bottom: 25px;
}

/* Buttons */
.btn-custom {
    border-radius: 8px;
    padding: 10px 18px;
}
</style>

</head>

<body>

<div class="container form-container">

    <!-- 🔥 HEADER -->
    <div class="page-header">
        <h3 class="fw-bold">➕ Add New Lead</h3>
        <p class="text-muted">Enter lead details below</p>
    </div>

    <!-- 🔥 CARD -->
    <div class="card-box">

        <!-- ERROR -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- 🔥 FORM -->
        <form method="POST" action="/leads/store">
            <?php echo csrf_field(); ?>

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">👤 Name</label>
                <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">📧 Email</label>
                <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter email">
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label fw-semibold">📞 Phone</label>
                <input type="text" name="phone" class="form-control shadow-sm" placeholder="Enter phone" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label fw-semibold">📊 Status</label>
                <select name="status" class="form-control shadow-sm">
                    <option value="New">New</option>
                    <option value="Contacted">Contacted</option>
                    <option value="Converted">Converted</option>
                </select>
            </div>

            <!-- 🔥 BUTTONS -->
            <div class="mt-4 d-flex justify-content-between">
                <a href="/leads" class="btn btn-outline-secondary btn-custom">⬅ Back</a>

                <div class="d-flex gap-2">
                    <a href="/leads/create" class="btn btn-outline-primary btn-custom">🔄 Reset</a>

                    <button type="submit" class="btn btn-success btn-custom"> ✔ Save Lead</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/leads/create.blade.php ENDPATH**/ ?>