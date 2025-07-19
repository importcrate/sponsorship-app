<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HoneypotMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->filled('company_name')) {
            Log::info('Honeypot triggered — blocked submission from IP: ' . $request->ip());
            return redirect()->back(); // or: abort(204);
        }

        return $next($request);
    }
}
