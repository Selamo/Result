<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'teacher') {
                return redirect()->route('teacher.showGrades');
            } elseif ($user->role == 'student') {
                return redirect()->route('student.viewResults');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Unauthorized access.');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    public function showRegisterAdminForm()
    {
        return view('auth.register_admin');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Auth::login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
