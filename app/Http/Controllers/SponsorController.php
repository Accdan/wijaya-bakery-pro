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

        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor berhasil ditambahkan!');
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
    
        // Proses jika ada gambar hasil crop
        if ($request->filled('cropped_logo')) {
            $imageData = $request->input('cropped_logo');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
    
            $imageName = time() . '_logo.png';
            $imagePath = public_path('uploads/sponsor/' . $imageName);
    
            // Hapus file lama
            if ($sponsor->logo_sponsor && file_exists(public_path('uploads/sponsor/' . $sponsor->logo_sponsor))) {
                unlink(public_path('uploads/sponsor/' . $sponsor->logo_sponsor));
            }
    
            // Simpan hasil crop
            file_put_contents($imagePath, base64_decode($imageData));
            $sponsor->logo_sponsor = $imageName;
        }
        // Atau kalau user upload langsung file baru (tanpa crop)
        elseif ($request->hasFile('logo_sponsor')) {
            if ($sponsor->logo_sponsor && file_exists(public_path('uploads/sponsor/' . $sponsor->logo_sponsor))) {
                unlink(public_path('uploads/sponsor/' . $sponsor->logo_sponsor));
            }
    
            $file = $request->file('logo_sponsor');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sponsor'), $filename);
            $sponsor->logo_sponsor = $filename;
        }
    
        $sponsor->save();
    
        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->deleteSponsor();

        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor berhasil dihapus.');
    }
}
