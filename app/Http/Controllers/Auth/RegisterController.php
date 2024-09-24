<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MasterDesignation;
use App\Models\MasterUser;
use App\Models\MasterEmployee;
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'required|string|max:15|unique:employees',
            'password' => 'required|string|min:8|confirmed',
            'designation_id' => 'required|exists:master_designation,id',
        ]);
        $employee = MasterEmployee::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        MasterUser::create([
            'username' => $request->username,
            'password' => md5::make($request->password),
            'employee_id' => $employee->id, // Link the employee to the user
            'designation_id' => $request->designation_id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}