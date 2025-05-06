<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'role_status' => 'required|boolean',
        ]);

        Role::createRole($request->all());

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'role_status' => 'required|boolean',
        ]);

        $role = Role::findOrFail($id);
        $role->updateRole($request->all());

        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->deleteRole();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $role = Role::findOrFail($id);
        $role->toggleStatus();

        return redirect()->route('role.index')->with('success', 'Status role diperbarui.');
    }
}
