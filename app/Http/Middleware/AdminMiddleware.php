<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if logged in and is admin
        if (!auth()->check() || auth()->user()->is_admin != 1) {
            return redirect('login')->with('error', 'Admin only!');
        }

        return $next($request);
    }
}
