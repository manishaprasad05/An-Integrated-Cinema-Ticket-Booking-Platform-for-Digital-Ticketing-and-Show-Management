<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // Admin routes
            if ($request->is('admin/*')) {
                return '/admin/login';
            }

            // User routes
            return '/user/login';
        }
    }
}
