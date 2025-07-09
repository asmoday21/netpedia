<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek jika pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah role pengguna ada di dalam array role yang diberikan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai, tampilkan pesan 403 Unauthorized
        return abort(403, 'Unauthorized access.');
    }
}
