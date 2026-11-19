<!DOCTYPE html>
<html>
<head>
    <title>Solar CRM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #f6c23e, #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 350px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #f6c23e, #f97316);
            border: none;
            color: white;
        }

        .btn-gradient:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/layouts/auth.blade.php ENDPATH**/ ?>