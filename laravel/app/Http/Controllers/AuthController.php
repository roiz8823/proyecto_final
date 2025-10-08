<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redireccionar según el rol
            if (Auth::user()->role === 'admin')
            {
                return redirect()->intended('/admin/dashboard');
            }
            else if (Auth::user()->role === 'mechanic')
            {
                return redirect()->intended('/mechanic/dashboard');
            }
            else
            {
                return redirect()->intended('/clients/dashboard');
            }
        }

        return back()->withErrors(['username' => 'Credenciales inválidas'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
