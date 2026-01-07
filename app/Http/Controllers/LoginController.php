<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            return $this->redirectBasedOnRole();
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user with 'author' role by default
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'author', // Default role for new registrations
        ]);

        // Auto login after registration
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully! Welcome to NewsPortal!');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Redirect users based on their role
     */
    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        // Simple role check - adjust based on your User model
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } 
        elseif ($user->role === 'editor') {
            return redirect()->route('editor.articles.pending')->with('success', 'Welcome Editor!');
        }
        else {
            // Default for authors and regular users
            return redirect()->route('dashboard')->with('success', 'Welcome to your dashboard!');
        }
    }
}