<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is Logged in and has is_admin = true
        if (auth()->check() && auth()->user()->is_admin)
        {
            return $next($request);
        }

        // Optionally, redirect to home with error or show 403
        abort(403, 'Unauthorized action');
    }
}
