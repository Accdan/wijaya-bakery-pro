<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo'       => 'required|string|max:255',
            'deskripsi_promo'  => 'nullable|string',
            'gambar_promo'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // WAJIB SAAT TAMBAH
            'status'           => 'required|boolean',
        ]);

        $data = $request->only(['nama_promo', 'deskripsi_promo', 'status']);

        if ($request->hasFile('gambar_promo')) {
            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $filename);
            $data['gambar_promo'] = $filename;
        }

        $promo = new Promo($data);
        $promo->id = (string) Str::uuid();
        $promo->save();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'nama_promo'       => 'required|string|max:255',
            'deskripsi_promo'  => 'nullable|string',
            'gambar_promo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // OPSIONAL SAAT EDIT
            'status'           => 'required|boolean',
        ]);

        $data = $request->only(['nama_promo', 'deskripsi_promo', 'status']);

        if ($request->hasFile('gambar_promo')) {
            // Hapus gambar lama jika ada
            if ($promo->gambar_promo && file_exists(public_path('uploads/promo/' . $promo->gambar_promo))) {
                unlink(public_path('uploads/promo/' . $promo->gambar_promo));
            }

            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $filename);
            $data['gambar_promo'] = $filename;
        }

        $promo->update($data);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);

        $path = public_path('uploads/promo/' . $promo->gambar);
        if ($promo->gambar_promo && File::exists($path)) {
            File::delete($path);
        }

        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}
