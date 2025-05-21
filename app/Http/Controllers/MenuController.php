<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->orderBy('created_at', 'desc')->get();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('menu.create', compact('kategoris'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_menu' => 'required|string|max:255',
    //         'deskripsi_menu' => 'nullable|string',
    //         'prosedur' => 'nullable|string',
    //         'gambar_menu' => 'required|string',
    //         'kategori_id' => 'required|exists:kategori,id',
    //     ]);

    //     $data = $request->all();
    //     $data['id'] = (string) Str::uuid();

    //     Menu::createMenu($data);

    //     return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    // }

    public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'deskripsi_menu' => 'required|string',
        'prosedur' => 'required|string',
        'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['nama_menu', 'deskripsi_menu', 'prosedur', 'kategori_id']);

    // Simpan file gambar jika ada
    if ($request->hasFile('gambar_menu')) {
        $file = $request->file('gambar_menu');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/menu'), $filename);
        $data['gambar_menu'] = $filename;
    }

    // Simpan ke database
    $menu = new Menu($data);
    $menu->id = (string) \Illuminate\Support\Str::uuid();
    $menu->save();

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
}


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        return view('menu.edit', compact('menu', 'kategoris'));
    }

    // public function update(Request $request, $id)
    // {
    //     $menu = Menu::findOrFail($id);

    //     $request->validate([
    //         'nama_menu' => 'required|string|max:255',
    //         'deskripsi_menu' => 'nullable|string',
    //         'prosedur' => 'nullable|string',
    //         'gambar_menu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'kategori_id' => 'required|exists:kategori,id',
    //     ]);

    //     $menu->updateMenu($request->all());

    //     return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    // }

    public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);

    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'deskripsi_menu' => 'required|string',
        'prosedur' => 'required|string',
        'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $menu->nama_menu = $request->nama_menu;
    $menu->kategori_id = $request->kategori_id;
    $menu->deskripsi_menu = $request->deskripsi_menu;
    $menu->prosedur = $request->prosedur;

    if ($request->hasFile('gambar_menu')) {
        $gambar = $request->file('gambar_menu')->store('menu', 'public');
        $menu->gambar_menu = $gambar;
    }

    $menu->save();

    return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
}


    public function show($id)
    {
        $menu = Menu::with('kategori')->findOrFail($id);
        return view('menu.show', compact('menu'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->deleteMenu();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
