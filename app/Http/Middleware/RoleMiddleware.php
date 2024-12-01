<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the authenticated user has the specified role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect or throw a 403 error if unauthorized
        return redirect()->route('guest')->with('error', 'Unauthorized access.');
    }
}
