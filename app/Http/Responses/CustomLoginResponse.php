<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($request->is('admin/login') && !$user->is_admin) {
            Auth::logout();
            return redirect('/admin/login')->withErrors([
                'email' => 'You are not authorized to access the admin panel.',
            ]);
        }

        if ($user->is_admin) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }
}
