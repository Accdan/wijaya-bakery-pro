<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsor.index', compact('sponsors'));
    }

    public function create()
    {
        return view('admin.sponsor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sponsor' => 'required|string|max:255',
            'deskripsi_sponsor' => 'required|string',
            'logo_sponsor' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_sponsor', 'deskripsi_sponsor']);

        if ($request->hasFile('logo_sponsor')) {
            $file = $request->file('logo_sponsor');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sponsor'), $filename);
            $data['logo_sponsor'] = $filename;
        }

        $sponsor = new Sponsor($data);
        $sponsor->id = (string) \Illuminate\Support\Str::uuid();
        $sponsor->save();

        return redirect()->route('sponsor.index')->with('success', 'Sponsor berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('admin.sponsor.edit', compact('sponsor'));
    }

    public function update(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);

        $request->validate([
            'nama_sponsor' => 'required|string|max:255',
            'deskripsi_sponsor' => 'required|string',
            'logo_sponsor' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $sponsor->nama_sponsor = $request->nama_sponsor;
        $sponsor->deskripsi_sponsor = $request->deskripsi_sponsor;

        if ($request->hasFile('logo_sponsor')) {
            if ($sponsor->logo_sponsor && file_exists(public_path('uploads/sponsor/' . $sponsor->logo_sponsor))) {
                unlink(public_path('uploads/sponsor/' . $sponsor->gambar_menu));
            }

            $file = $request->file('logo_sponsor');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sponsor'), $filename);
            $sponsor->logo_sponsor = $filename;
        }

        $sponsor->save();

        return redirect()->route('sponsor.index')->with('success', 'Sponsor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->deleteSponsor();

        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor berhasil dihapus.');
    }
}
