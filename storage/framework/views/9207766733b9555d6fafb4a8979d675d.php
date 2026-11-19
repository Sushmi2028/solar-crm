<!DOCTYPE html>
<html>
<head>
<title>Customer Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h4>Customer Details</h4>
        <div class="card p-3">
            <p><strong>Name:</strong> <?php echo e($customer->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($customer->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($customer->phone); ?></p>
        </div>
    <a href="/customers" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/customers/show.blade.php ENDPATH**/ ?>