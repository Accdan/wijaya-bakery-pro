<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::orderBy('created_at', 'asc')->with('role')->get();
        return view('pengguna.penggunaList', compact('penggunas'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pengguna.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengguna,username',
            'email' => 'nullable|email|max:255|unique:pengguna,email',
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'profile_picture' => 'nullable|string',
            'role_id' => 'required|exists:role,id',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Pengguna::createPengguna($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $roles = Role::all();
        return view('pengguna.edit', compact('pengguna', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengguna,username,' . $pengguna->id,
            'email' => 'nullable|email|max:255|unique:pengguna,email,' . $pengguna->id,
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|string',
            'role_id' => 'required|exists:role,id',
        ]);

        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // jangan update kalau kosong
        }

        $pengguna->updatePengguna($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function show($id)
    {
        $pengguna = Pengguna::with('role')->findOrFail($id);
        return view('pengguna.show', compact('pengguna'));
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->deletePengguna();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
