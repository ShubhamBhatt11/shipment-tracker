<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 600; letter-spacing: 0.5px; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ route('home') }}">📦 Shipment Tracker</a>
    <a href="{{ route('shipments.index') }}" class="btn btn-sm btn-outline-light">All Shipments</a>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
