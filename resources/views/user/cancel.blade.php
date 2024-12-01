@extends('layouts.appUser')

@section('content')
<div class="container text-center" style="padding-top: 100px;">
    <h3>Payment Canceled</h3>
    <p>Your payment was canceled. You can return to your cart to try again.</p>
    <a href="{{ route('cart.index') }}" class="btn btn-primary">Return to Cart</a>
</div>
@endsection
