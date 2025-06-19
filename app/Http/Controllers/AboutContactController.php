<?php

namespace App\Http\Controllers;

use App\Models\AboutNContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutContactController extends Controller
{
    // Tampilkan form edit (asumsinya hanya 1 data)
    public function index()
    {
        $data = AboutNContact::first(); // hanya ada 1 baris
        return view('admin.about_contact.index', compact('data'));
    }

    // Simpan atau update
    public function update(Request $request, $id)
    {
        $request->validate([
            'about_deskripsi'     => 'nullable|string',
            'about_picture'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_deskripsi'   => 'nullable|string',
            'contact_picture'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = AboutNContact::firstOrNew(['id' => $id]);


        // Handle gambar about
        if ($request->hasFile('about_picture')) {
            if ($data->about_picture && File::exists(public_path('uploads/about_contact/' . $data->about_picture))) {
                File::delete(public_path('uploads/about_contact/' . $data->about_picture));
            }
            $aboutFile = $request->file('about_picture');
            $aboutFilename = time() . '_about_' . Str::random(8) . '.' . $aboutFile->getClientOriginalExtension();
            $aboutFile->move(public_path('uploads/about_contact'), $aboutFilename);
            $data->about_picture = $aboutFilename;
        }

        // Handle gambar contact
        if ($request->hasFile('contact_picture')) {
            if ($data->contact_picture && File::exists(public_path('uploads/about_contact/' . $data->contact_picture))) {
                File::delete(public_path('uploads/about_contact/' . $data->contact_picture));
            }
            $contactFile = $request->file('contact_picture');
            $contactFilename = time() . '_contact_' . Str::random(8) . '.' . $contactFile->getClientOriginalExtension();
            $contactFile->move(public_path('uploads/about_contact'), $contactFilename);
            $data->contact_picture = $contactFilename;
        }

        // Simpan deskripsi
        $data->about_deskripsi = $request->about_deskripsi;
        $data->contact_deskripsi = $request->contact_deskripsi;

        $data->save();

        return redirect()->back()->with('success', 'Data About & Contact berhasil disimpan.');
    }
}
