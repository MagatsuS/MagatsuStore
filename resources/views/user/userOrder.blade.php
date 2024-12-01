@extends('layouts.appUser')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Your Orders</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
        <a href="{{ route('user') }}" class="btn btn-primary">Shop Now</a>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Order #{{ $order->id }}</h5>
                            <span class="badge 
                                {{ $order->shipping_status == 'Pending' ? 'bg-warning' : 'bg-success' }}">
                                {{ $order->shipping_status }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p><strong>Total Price:</strong> RM{{ number_format($order->total_price, 2) }}</p>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
