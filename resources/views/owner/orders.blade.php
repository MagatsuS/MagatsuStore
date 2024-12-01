@extends('layouts.appOwner') <!-- Extending the appOwner layout -->

@section('title', 'All Orders - MagatsuStore') <!-- Set the page title for orders -->

@section('content') <!-- Content specific to this page -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">All Orders</h1>

        <!-- Table displaying orders -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Order List</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Shipping Status</th>
                            <th>Tracking Number</th>
                            <th>Address</th>
                            <th>Products</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>RM{{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->shipping_status === 'Shipped' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $order->shipping_status }}
                                    </span>
                                </td>
                                <td>{{ $order->tracking_number ?? 'N/A' }}</td>
                                <td>
                                    @if($order->user->addresses->isNotEmpty())
                                        {{ $order->user->addresses->first()->address_line_1 }},
                                        {{ $order->user->addresses->first()->address_line_2 }},
                                        {{ $order->user->addresses->first()->city }},
                                        {{ $order->user->addresses->first()->state }},
                                        {{ $order->user->addresses->first()->postal_code }}
                                    @else
                                        <span class="text-muted">No address provided</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($order->products as $product)
                                            <li>
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                {{ $product->name }} - Quantity: {{ $product->pivot->quantity }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional: Add a Footer with More Info -->
    <div class="container mt-4">
        <footer class="text-center text-muted">
            <p>© 2024 MagatsuStore - All Rights Reserved</p>
        </footer>
    </div>
@endsection

<!-- Optional: Add Bootstrap Icons for product listing -->
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
