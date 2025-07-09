<?php

// app/Http/Middleware/EnsureUserIsGuru.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsGuru
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'guru') {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk guru');
    }
}