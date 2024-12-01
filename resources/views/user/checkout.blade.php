@extends('layouts.appUser')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
    <div class="col-md-8">
        <h3 class="text-center mb-4">Checkout</h3>

        <!-- Address Information -->
        <div class="mb-4">
            <h4>Shipping Address</h4>
            @if($address)
                <p><strong>Address Line 1:</strong> {{ $address->address_line_1 }}</p>
                <p><strong>Address Line 2:</strong> {{ $address->address_line_2 ?? 'N/A' }}</p>
                <p><strong>City:</strong> {{ $address->city }}</p>
                <p><strong>State:</strong> {{ $address->state }}</p>
                <p><strong>Postal Code:</strong> {{ $address->postal_code }}</p>
            @else
            <p>No address found. <a href="{{ route('address.create') }}" class="btn btn-secondary w-100 mt-2">Add an address</a>.</p>
            @endif
        </div>

        <!-- Cart Summary -->
        @if(!$cartItems->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>RM{{ number_format($item->product->price, 2) }}</td>
                            <td>RM{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total Price:</strong></td>
                        <td>RM{{ number_format($totalPrice, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100 mt-4">Proceed to Payment</button>
            </form>
        @else
            <p>Your cart is empty. <a href="{{ route('user') }}">Shop now</a>.</p>
        @endif
    </div>
</div>
@endsection
