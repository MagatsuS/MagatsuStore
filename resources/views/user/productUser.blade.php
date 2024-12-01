@extends('layouts.appUser')

@section('content')
<div class="container my-5 mt-4">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-6">
            <div class="card shadow-sm rounded mt-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="col-md-6 mt-4">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>

            <!-- Product Price -->
            <h2 class="text-danger" id="totalPrice">RM{{ number_format($product->price, 2) }}</h2>

            <!-- Quantity Selection -->
            <div class="quantity-container d-flex align-items-center mb-3">
                <button type="button" class="btn btn-secondary decrement" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control mx-2 number-input" style="width: 60px; text-align: center;">
                <button type="button" class="btn btn-secondary increment" onclick="increaseQuantity()">+</button>
            </div>

            <!-- Add to Cart Button -->
            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="cartQuantity" name="quantity" value="1">
                <button type="submit" class="btn btn-primary me-2">Add to Cart</button>
            </form>

            <!-- Buy Now Button -->
            <!-- <form action="{{ route('checkout.show') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="cartQuantity" name="quantity" value="1">
                <button type="submit" class="btn btn-success me-2">Buy Now</button>
            </form> -->

        </div>
    </div>
</div>

<!-- Quantity Sync Script -->
<script>
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const cartQuantityInput = document.getElementById('cartQuantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        cartQuantityInput.value = quantityInput.value;
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const cartQuantityInput = document.getElementById('cartQuantity');
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            cartQuantityInput.value = quantityInput.value;
        }
    }

    // Sync hidden input with quantity field on change
    document.getElementById('quantity').addEventListener('input', function() {
        document.getElementById('cartQuantity').value = this.value;
    });

    document.addEventListener("DOMContentLoaded", function() {
        const quantityInput = document.getElementById('quantity');
        const totalPriceElement = document.getElementById('totalPrice');
        const productPrice = {{ $product->price }}; // The product price in PHP, converted to JS

        // Function to update the total price
        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value);
            const totalPrice = productPrice * quantity;
            totalPriceElement.innerHTML = "RM" + totalPrice.toFixed(2); // Update the total price dynamically
        }

        // Event listener to update the price whenever the quantity changes
        quantityInput.addEventListener('input', function() {
            updateTotalPrice();
        });

        // Initialize the total price on page load
        updateTotalPrice();
    });

    // Sync hidden input with quantity field on change
    document.getElementById('quantity').addEventListener('input', function() {
        document.getElementById('cartQuantity').value = this.value;
    });
    
    // Function to increase quantity
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        document.getElementById('cartQuantity').value = quantityInput.value; // Sync hidden input
    }

    // Function to decrease quantity
    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            document.getElementById('cartQuantity').value = quantityInput.value; // Sync hidden input
        }
    }
</script>

<style>
    .number-input::-webkit-inner-spin-button,
    .number-input::-webkit-outer-spin-button {
        -webkit-appearance: none; /* Remove default buttons */
        margin: 0; /* Remove margin */
    }

    .number-input {
        -moz-appearance: textfield; /* For Firefox, hide spin buttons */
    }

    .quantity-container:hover .number-input::-webkit-inner-spin-button,
    .quantity-container:hover .number-input::-webkit-outer-spin-button {
        display: none; /* Hide spin buttons on hover */
    }
</style>

@endsection
