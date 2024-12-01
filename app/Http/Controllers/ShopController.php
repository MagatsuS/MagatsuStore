<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();

        // Pass products to the view
        return view('user.user', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Finds the product by ID
    
        return view('user.productUser', compact('product')); // Make sure this view exists
    }   
}
