<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // Set a flash message for SweetAlert
            $response = [
                'success' => false,
                'title' => 'Gagal',
                'message' => 'You are already logged in.',
            ];

            // Redirect authenticated users with the response
            return redirect()->route('admin.permohonan')->with('response', $response);
        }

        return $next($request);
    }
}
