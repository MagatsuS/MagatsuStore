<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class PaymentController extends Controller
{
    public function index()
    {
        return view('user.cart');
    }

    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));

        // Retrieve the cart items for the authenticated user and calculate the total price
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        // Create a Stripe Checkout Session with the calculated total price
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency'  => 'myr',
                        'product_data'  => [
                            'name' => 'Cart Total',
                        ],
                        'unit_amount' => $totalPrice * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cart.index'),
        ]);

        return redirect()->away($session->url);
    }

    public function directCheckout(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
        // Retrieve the product and quantity from the request
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default to 1 if not provided
        
        // Fetch the product details
        $product = Product::findOrFail($productId);
        $totalPrice = $product->price * $quantity; // Calculate total price
        
        // Create a Stripe Checkout Session with the calculated total price
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $totalPrice * 100, // Convert to cents
                    ],
                    'quantity' => $quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('product.show', ['id' => $productId]),
        ]);
        
        return redirect()->away($session->url);
    }        

    public function success()
    {
        // Retrieve the cart items for the authenticated user
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        // Calculate the total price of the cart items
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);
    
        // Optionally, save the order to the database if you have an Order model
        // Assuming you have an Order model and a migration already set up
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'shipping_status' => 'Pending', 
            'tracking_number' => Order::generateDummyTrackingNumber(),
        ]);
    
        // You can also attach the products to the order if necessary
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product_id, ['quantity' => $item->quantity]);
        }
    
        // Optionally, clear the cart after successful order creation
        Cart::where('user_id', auth()->id())->delete(); // Clear the cart
    
        // Redirect to the userOrder view with the order data
        return redirect()->route('user.orders.show', ['id' => $order->id]);
    }
}    
