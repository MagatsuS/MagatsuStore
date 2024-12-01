<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import the Order model

class OwnerController extends Controller
{
    // Constructor to ensure the user is authenticated and has the correct role
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
    
        if ($user->role != 'owner') {
            return redirect()->route('user')->with('error', 'Access denied! You are not an owner.');
        }             
    
        return view('owner.owner');
    }

    // Method to view all orders
    public function showAllOrders()
    {
        // Use the correct relationship name 'addresses' (plural)
        $orders = Order::with(['user.addresses', 'products'])->get();
        return view('owner.orders', compact('orders'));
    }    
}
