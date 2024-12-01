@extends('layouts.appOwner')

@section('title', 'Products - MagatsuStore')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">All Products</h1>

        <!-- Add Product Button -->
        <div class="text-right mb-3">
            <a href="{{ route('owner.product.create') }}" class="btn btn-success btn-lg">Add Product</a>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card product-card shadow-sm border-light rounded">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top fixed-image-size" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text text-muted text-center"><strong>Price:</strong> RM{{ number_format($product->price, 2) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('owner.product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit Product</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('owner.product.delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    /* Styling for consistent image size */
    .fixed-image-size {
        width: 100%; 
        height: 200px; /* Adjust height to fit all images uniformly */
        object-fit: cover; 
    }

    /* Styling for the product cards */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-10px); 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow on hover */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    .btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Add spacing and center elements */
    .text-center {
        text-align: center;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 20px;
        }

        .fixed-image-size {
            height: 180px;
        }
    }
</style>
