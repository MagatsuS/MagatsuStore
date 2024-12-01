<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database

        if (Auth::check()) {
            $user = Auth::user(); // Get the authenticated user

            if ($user->role === 'owner') {
                // Return the products view for the owner
                return view('owner.products', compact('products'));
            } else {
                // If user is authenticated but not an owner, show the user product view
                return view('user.productUser', compact('products'));
            }
        } else {
            // If the user is not authenticated, show the guest product view
            return view('productGuest', compact('products'));
        }
    }

    public function showGuestProduct($id) // Accept the product ID
    {
        // Find the product by ID
        $product = Product::findOrFail($id); // This will throw a 404 if not found
        
        // Return the product details view for the guest
        return view('productGuest', compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.productDetails', compact('product'));
    }

    public function create()
    {
        return view('owner.createProduct');
    }      

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure image validation
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('products', 'public');

        // Create the new product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Store image path in the database
        ]);

        return redirect()->route('owner.products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);  // Get the product by ID
        return view('owner.editProduct', compact('product'));  // Return the edit view with the product data
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Update product fields
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // Update image if uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('owner.products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Find the product by ID
        $product->delete(); // Delete the product

        return redirect()->route('owner.products')->with('success', 'Product deleted successfully!');
    }
}