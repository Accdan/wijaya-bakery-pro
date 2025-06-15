<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
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
            'nama_promo'     => 'required|string|max:255',
            'deskripsi_promo'      => 'nullable|string',
            'gambar_promo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'         => 'required|boolean',
        ]);

        $data = $request->only([
            'nama_promo',
            'deskripsi_promo',
            'gambar_promo',
            'status',
        ]);

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
            'nama_promo'     => 'required|string|max:255',
            'deskripsi_promo'      => 'nullable|string',
            'gambar_promo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'         => 'required|boolean',
        ]);

        $promo->update([
            'nama_promo'     => $request->nama_promo,
            'deskripsi_promo'=> $request->deskripsi_promo,
            'gambar_promo'   => $request->gambar_promo,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}
