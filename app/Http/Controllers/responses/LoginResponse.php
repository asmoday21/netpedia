<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'guru':
                return redirect()->intended('/guru/dashboard');
            case 'siswa':
                return redirect()->intended('/siswa/dashboard');
            default:
                return redirect()->intended('/');
        }
    }
}
