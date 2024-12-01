<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Get the authenticated user
            $user = Auth::user();

            // Redirect based on the user's role
            if ($user->role === 'user') {
                return redirect()->route('user'); // User dashboard route
            } elseif ($user->role === 'owner') {
                return redirect()->route('owner.page'); // Owner dashboard route
            } else {
                return redirect()->route('guest'); // Fallback route (if needed)
            }
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}
