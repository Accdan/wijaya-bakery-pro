<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class AboutNContact extends Model
{
    protected $table = 'about_ncontact';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'about_deskripsi',
        'about_picture',
        'contact_deskripsi',
        'contact_picture',
    ];

    // Event boot untuk menghapus file gambar jika data dihapus atau diperbarui
    protected static function booted()
    {
        static::deleting(function ($item) {
            foreach (['about_picture', 'contact_picture'] as $field) {
                if ($item->$field) {
                    $path = public_path('uploads/about_contact/' . $item->$field);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }
        });

        static::updating(function ($item) {
            $original = $item->getOriginal();
            foreach (['about_picture', 'contact_picture'] as $field) {
                if ($item->$field !== $original[$field] && $original[$field]) {
                    $oldPath = public_path('uploads/about_contact/' . $original[$field]);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
            }
        });
    }

    // Fungsi untuk ambil deskripsi dengan decode Quill (HTML)
    public function getDecodedAbout()
    {
        return $this->about_deskripsi;
    }

    public function getDecodedContact()
    {
        return $this->contact_deskripsi;
    }

    // Fungsi untuk ambil URL gambar
    public function getAboutPictureUrl()
    {
        return $this->about_picture
            ? asset('uploads/about_contact/' . $this->about_picture)
            : asset('images/default-about.jpg');
    }

    public function getContactPictureUrl()
    {
        return $this->contact_picture
            ? asset('uploads/about_contact/' . $this->contact_picture)
            : asset('images/default-contact.jpg');
    }
}
