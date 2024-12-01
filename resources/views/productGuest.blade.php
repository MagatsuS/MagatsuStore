@extends('layouts.appGuest')

@section('content')
<div class="container my-5 mt-4">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-6">
            <div class="row mt-4">
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm rounded" style="transition: transform 0.2s;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="col-md-6 mt-4">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>

            <!-- Product Price -->
            <h2 class="text-danger">RM{{ number_format($product->price, 2) }}</h2>

            <!-- Quantity Selection -->
            <div class="quantity-container d-flex align-items-center mb-3">
                <button type="button" class="btn btn-secondary decrement" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1" class="form-control mx-2 number-input" style="width: 60px; text-align: center;">
                <button type="button" class="btn btn-secondary increment" onclick="increaseQuantity()">+</button>
            </div>

            <!-- Add to Cart Button -->
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Add to Cart</a>
    
        </div>
    </div>
</div>

<script>
    function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    function decreaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
</script>

@endsection
