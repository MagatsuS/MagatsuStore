<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

    // Show cart items for the user
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
    
        // Calculate the total price
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);
    
        return view('user.cart', compact('cartItems', 'totalPrice'));
    }    

    // Add item to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = auth()->id(); // Get logged-in user ID

        // Check if the product is already in the cart for this user
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            // Update quantity if it already exists
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create a new cart item
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure quantity is valid
        ]);
    
        // Update the quantity in the database
        $cartItem = Cart::where('id', $id)->first(); // Assuming 'id' is the primary key
        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
    
            return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Cart item not found']);
    }
    
    public function remove($id)
    {
        // Assuming you have a Cart model that handles the user's cart
        // and a method to find and remove the item from the cart.

        // Find the cart item by ID
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            // Remove the item from the cart
            $cartItem->delete();
            
            // Optionally, you can return a response if you want to handle AJAX
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        // If the item is not found, you can return an error response
        return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
    }
}
