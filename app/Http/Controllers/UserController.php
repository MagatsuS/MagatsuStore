<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();  // Get the authenticated user
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }
    
        // Check if user is an owner (role 2) or a regular user (role 1)
        if ($user->role === 'owner') {
            // Redirect to the owner page if the user is an owner
            return redirect()->route('owner.page');  // You should use 'owner.page' instead of 'owner.owner'
        }        
    
        // If user is a regular user (role 1), proceed with the user profile page
        return view('user.profile', compact('user'));
    }    
    
    // Update user profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        // Update the authenticated user's information
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    public function profile()
    {
        // Assuming the user's profile view is named 'profile' and located in the 'user' folder
        return view('user.profile'); // You can change the view name if needed
    }

    public function showProduct()
    {
        $products = \App\Models\Product::all();  // Fetch all products
        return view('user.user', compact('products'));
    }
}
