<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        Kategori::createKategori($request->only('nama_kategori'));
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Memperbarui data kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        $kategori = Kategori::findOrFail($id);
        $kategori->updateKategori($request->only('nama_kategori'));
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }
    

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->deleteKategori();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // Toggle status kategori (aktif / tidak aktif)
    public function toggleStatus($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status kategori berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
