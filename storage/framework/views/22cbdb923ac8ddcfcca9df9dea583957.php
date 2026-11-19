<!DOCTYPE html>
<html>
<head>
<title>Edit Customer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
<h4>Edit Customer</h4>

<form method="POST" action="/customers/update/<?php echo e($customer->id); ?>">
<?php echo csrf_field(); ?>

<input type="text" name="name" class="form-control mb-2" value="<?php echo e($customer->name); ?>" required>

<input type="email" name="email" class="form-control mb-2" value="<?php echo e($customer->email); ?>">

<input type="text" name="phone" class="form-control mb-2" value="<?php echo e($customer->phone); ?>" required>

<textarea name="address" class="form-control mb-2"><?php echo e($customer->address); ?></textarea>

<button class="btn btn-success">Update</button>

</form>

</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customers/edit.blade.php ENDPATH**/ ?>