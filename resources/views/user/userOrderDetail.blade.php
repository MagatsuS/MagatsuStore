@extends('layouts.appUser')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Order Details</h1>

    <div class="card border-light shadow-sm mb-4">
        <div class="card-body">
            <h3>Order #{{ $order->id }}</h3>
            <p><strong>Total Price:</strong> RM{{ number_format($order->total_price, 2) }}</p>
            <p><strong>Shipping Status:</strong> 
                <span class="badge 
                    {{ $order->shipping_status == 'Pending' ? 'bg-warning' : 'bg-success' }}">
                    {{ $order->shipping_status }}
                </span>
            </p>
            <p><strong>Tracking Number:</strong> {{ $order->tracking_number ?? 'Not available' }}</p>
        </div>
    </div>

    <h4>Products in This Order:</h4>
    <div class="list-group mb-4">
        @foreach($order->products as $product)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- Updated Product Image Path and Size -->
                    <img src="{{ asset('storage/' . $product->image) }}" class="me-3 fixed-image-size" alt="{{ $product->name }}">
                    <div>
                        <h5 class="mb-1">{{ $product->name }}</h5>
                        <p class="mb-0">Quantity: {{ $product->pivot->quantity }}</p>
                    </div>
                </div>
                <span class="text-muted">
                    RM{{ number_format($product->price * $product->pivot->quantity, 2) }}
                </span>
            </div>
        @endforeach
    </div>

    <a href="{{ route('user.userOrder') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back to Orders
    </a>
</div>
@endsection

<style>
    /* Fixed size for product images */
    .fixed-image-size {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px; /* Rounded corners for the image */
    }
</style>
