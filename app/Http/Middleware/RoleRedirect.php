<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin':
                return redirect('/admin/admin_master');
            case 'guru':
                return redirect('/guru/guru_master');
            case 'siswa':
                return redirect('/siswa/siswa_master');
        }
    }

    return $next($request);
}

}
