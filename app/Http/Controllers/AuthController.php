<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showUserLoginForm()
    {
        return view('auth.login-user');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->with('role')->first();
        // dd($user->role());
        if (!$user || $user->role->role_name !== 'pengguna') {
            return back()->with('error', 'Username tidak ditemukan atau bukan user biasa.')
                        ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                        ->withInput($request->only('username'));
        }

        Auth::guard('users')->login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard-user');
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
            'role_id' => 'required|exists:roles,id',  // pastikan tabel roles ada
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role tidak ditemukan.',
        ]);

        $filename = null;
        if ($request->hasFile('profile_picture')) {
            $filename = $request->file('profile_picture')->store('profile', 'public');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
            'profile_picture' => $filename,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();
        // dd($user);
        if (!$user || $user->role_id !== '6ef8fcb8-7bd8-4279-b26b-b06b20b78043') {
            return back()->with('error', 'Username tidak ditemukan atau bukan admin.')
                        ->withInput($request->only('username'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')
                        ->withInput($request->only('username'));
        }

        Auth::guard('admin')->login($user);
        $request->session()->regenerate();

        // dd(Auth::guard('admin')->user());

        return redirect('/dashboard-admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-user')->with('success', 'Logout berhasil!');
    }
}
