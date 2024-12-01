<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get(); // Retrieve orders for the authenticated user

        return view('user.userOrder', compact('orders')); // Updated view name
    }

    public function showOrder($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);

        return view('user.userOrderDetail', compact('order')); // Updated view name
    }
}
