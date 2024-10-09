<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the sign-up form
    public function showSignupForm()
    {
        return view('signup');
    }

    // Handle sign-up form submission
    public function signup(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Optionally, you can log the user in and redirect to a dashboard
        // Auth::login($user);

        return redirect()->route('signup')->with('success', 'User successfully registered!');
    }
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, redirect to intended page or dashboard
            return redirect()->intended('/dashboard')->with('success', 'Login successful!');
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }
    public function logout()
{
    Auth::logout();
    return redirect()->route('login')->with('success', 'You have been logged out.');
}

}

