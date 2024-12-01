@extends('layouts.appOwner') <!-- Extending the appOwner layout -->

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - MagatsuStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100"> <!-- Ensuring the body takes full viewport height -->

    <!-- Main Content Section -->
    <div class="container mt-5 flex-grow-1"> <!-- Ensures content takes all available space -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Welcome to the Owner Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center">Manage your store, view orders, and products here.</p>

                        <div class="row justify-content-between">
                            <div class="col-md-5 mb-3">
                                <div class="card border-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Your Products</h5>
                                        <p class="card-text">View and manage your store's products here.</p>
                                        <a href="{{ route('owner.products') }}" class="btn btn-outline-primary">View Products</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <div class="card border-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Your Orders</h5>
                                        <p class="card-text">View and manage your store's orders here.</p>
                                        <a href="{{ route('owner.orders') }}" class="btn btn-outline-success">View Orders</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section (sticky at the bottom) -->
    <footer class="bg-light text-center py-3 mt-auto">
        <small class="text-muted">MagatsuStore - All rights reserved &copy; 2024</small>
    </footer>

    <!-- Optional: Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    /* Optional: Add custom hover effect on nav items */
    .nav-link:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    /* Custom styling for cards */
    .card {
        border-radius: 10px;
    }
    .card-body {
        padding: 2rem;
    }

    /* Button hover effects */
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
    .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
    }

    /* Make footer stick to the bottom */
    footer {
        position: relative;
        bottom: 0;
        width: 100%;
    }

    /* Ensure the content takes up all available height */
    .flex-grow-1 {
        flex-grow: 1;
    }

    /* Custom footer styling */
    footer {
        background-color: #f8f9fa;
        color: #6c757d;
    }
</style>

@endsection
