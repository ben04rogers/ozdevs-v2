<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate the registration data
        $validatedData = $request->validate([
            'user_type' => 'required|in:developer,company',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'user_type' => $validatedData['user_type'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect the user after successful registration
        return redirect()->route('getStarted')->with('success', 'Registration successful!');
    }
}
