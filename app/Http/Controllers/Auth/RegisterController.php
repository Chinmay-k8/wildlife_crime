<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MasterDesignation;
use App\Models\MasterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $designations = MasterDesignation::all();
        return view('auth.register', compact('designations'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:master_user',
            'email' => 'required|string|email|max:255|unique:master_user',
            'mobile_number' => 'required|string|max:15|unique:master_user',
            'password' => 'required|string|min:8|confirmed',
            'designation_id' => 'required|exists:master_designation,id',
        ]);

        MasterUser::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'designation_id' => $request->designation_id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}