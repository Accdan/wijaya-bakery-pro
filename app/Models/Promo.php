<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $table = 'promo';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_promo',
        'deskripsi_promo',
        'gambar_promo',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($promo) {
            if (!$promo->id) {
                $promo->id = (string) Str::uuid();
            }
        });
        // Hapus gambar saat record dihapus
        static::deleting(function ($promo) {
        if ($promo->gambar) {
            $path = public_path('uploads/promo/' . $promo->gambar_promo);
            if (File::exists($path)) {
                File::delete($path);
            }
            }
        });
    }

    public static function createPromo($data)
    {
        return self::create([
            'nama_promo'     => $data['nama_promo'],
            'deskrpsi_promo'      => $data['deskrpsi_promo'],
            'gambar_promo'   => $data['gambar_promo'] ?? null,
            'status'         => $data['status'] ?? true,
        ]);
    }

    public function updatePromo($data)
    {
        return $this->update([
            'nama_promo'     => $data['nama_promo'] ?? $this->nama_promo,
            'deskrpsi_promo' => $data['deskrpsi_promo'] ?? $this->deskrpsi_promo,
            'gambar_promo'   => $data['gambar_promo'] ?? $this->gambar_promo,
            'status'         => $data['status'] ?? $this->status,
        ]);
    }

    public function deletePromo()
    {
        return $this->delete();
    }
}
