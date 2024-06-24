<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('/admin');
        }

        return $next($request);
    }
}