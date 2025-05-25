<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();
    
       
        if (request()->is('login') && $user->role === 'admin') {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Access Denied!']);
        }
    
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }
    
        return redirect()->intended('/dashboard');
    }
}
