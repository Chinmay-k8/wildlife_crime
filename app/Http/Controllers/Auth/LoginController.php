<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterUser;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        $user = MasterUser::where('username', $request->username)->first();
    
        if ($user && md5($request->password) === $user->password) {
            Auth::login($user);
            return redirect()->intended('dashboard'); // Replace 'dashboard' with your intended route after login
        }
    
        return redirect()->back()->withErrors(['user_name' => 'Invalid credentials'])->withInput();
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
