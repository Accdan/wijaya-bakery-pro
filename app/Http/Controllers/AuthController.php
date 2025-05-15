<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            Log::info('Login berhasil untuk: ' . $request->username);
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        Log::warning('Login gagal untuk: ' . $request->username);
        throw ValidationException::withMessages([
            'username' => ['Username atau password salah.'],
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
            'profile_picture' => $filename,
            'role_id' => '6fe4ee1b-943d-4ee3-afdd-f77364cca715',
        ]);

        // Auth::login($user);

        //return redirect('/login')->with('success', 'Registrasi berhasil!');
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
