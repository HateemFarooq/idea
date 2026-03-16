<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function loginPage()
    {
        return Inertia::render('Login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email field is required',
            'email.email' => 'Please enter a valid email',
            'password.required' => 'Password field is required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login successfully');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logged out successfully');
    }
}
