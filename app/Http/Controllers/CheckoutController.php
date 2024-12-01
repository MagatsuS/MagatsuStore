<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Order;
use Auth;

class CheckoutController extends Controller
{
    public function directCheckout(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        
        return redirect()->route('checkout.show')
                         ->with([
                             'product_id' => $productId,
                             'quantity' => $quantity,
                         ]);
    }          

    public function show(Request $request)
    {
        $userId = auth()->id();
    
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
    
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);
    
        $address = Address::where('user_id', $userId)->first();
    
        return view('user.checkout', compact('cartItems', 'totalPrice', 'address'));
    }                 
    
    public function processCheckout(Request $request)
    {
        // Set Stripe API key
        Stripe::setApiKey(config('stripe.sk'));

        $userId = auth()->id();
        
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',  // Replace with the currency you use
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $userId = auth()->id();
    
        // Retrieve cart items
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
    
        // Calculate total price
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);
    
        // Create a new Order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'shipping_status' => 'Pending', // Set default status
            'tracking_number' => Order::generateDummyTrackingNumber(),
        ]);
    
        // Associate each cart item with the order
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product->id, [
                'quantity' => $item->quantity,
            ]);
        }
    
        // Clear the user's cart
        Cart::where('user_id', $userId)->delete();
    
        return view('user.success', compact('order'));
    }

    public function cancel()
    {
        return view('user.cancel');
    }
}
