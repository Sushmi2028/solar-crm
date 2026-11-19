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
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        </div>
    <a href="/customers" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html>