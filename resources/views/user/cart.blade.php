@extends('layouts.appUser')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    <!-- Display success message if it exists -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
        <a href="{{ route('user') }}" class="btn btn-primary">Shop Now</a> <!-- "Shop Now" button -->
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr id="cart-item-{{ $item->id }}">
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top fixed-image-size" alt="{{ $item->product->name }}">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td class="product-price" data-price="{{ $item->product->price }}">RM{{ number_format($item->product->price, 2) }}</td>
                        <td>
                            <div class="quantity-container d-flex align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" min="1" class="number-input" style="width: 60px; text-align: center;" />
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                            </div>
                        </td>
                        <td id="total-{{ $item->id }}">
                            RM{{ number_format($item->product->price * $item->quantity, 2) }}
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tr>
                <td class="text-start"><strong>Total Price:</strong></td>
                <td colspan="3"></td> <!-- Empty columns to push the total price to the right -->
                <td id="cart-total" style="text-align: left;">RM{{ number_format($totalPrice, 2) }}</td>
                <td></td>
            </tr>
        </table>

        <!--Checkout button-->
        <div class="card shadow-sm p-4">
            <form action="{{ route('checkout.show') }}" method="POST">
                @csrf
                <a href="{{ route('user') }}" class="btn btn-secondary w-100 mt-2">Shop More</a>
                <button type="submit" class="btn btn-primary w-100 mt-4">Checkout</button>
            </form>
        </div>
    @endif
</div>

<script>
    function updateQuantity(itemId, change) {
        // Get the current quantity
        let quantityInput = document.getElementById('quantity-' + itemId);
        let currentQuantity = parseInt(quantityInput.value);

        // Calculate the new quantity
        let newQuantity = currentQuantity + change;

        // Ensure new quantity is at least 1
        if (newQuantity < 1) {
            newQuantity = 1;
        }

        // Update the input field
        quantityInput.value = newQuantity;

        // Update total price for this item
        calculateTotal(itemId);
        updateCartTotal();

        // Send an AJAX request to update the quantity in the database
        fetch(`/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data.message); // Success message
            } else {
                console.error(data.message); // Error message
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function calculateTotal(itemId) {
        // Get the price of the product from the data attribute
        let priceElement = document.querySelector(`#cart-item-${itemId} .product-price`);
        let price = parseFloat(priceElement.getAttribute('data-price'));
        let quantity = parseInt(document.getElementById('quantity-' + itemId).value);
        let totalElement = document.getElementById('total-' + itemId);

        // Calculate the total price
        let totalPrice = price * quantity;

        // Update the total price in the table
        totalElement.innerHTML = `RM${totalPrice.toFixed(2)}`;
    }

    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('[id^="total-"]').forEach(totalElement => {
            total += parseFloat(totalElement.innerHTML.replace('RM', ''));
        });
        
        document.getElementById('cart-total').innerHTML = `RM${total.toFixed(2)}`;
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

    .fixed-image-size {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }
</style>

@endsection
