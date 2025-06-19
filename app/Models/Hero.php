<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Hero extends Model
{
    protected $table = 'heroes';
    protected $keyType = 'string'; // UUID
    public $incrementing = false;

    protected $fillable = [
        'id',
        'gambar',
        'status',
    ];

    // Generate UUID saat create
    protected static function booted()
    {
        static::creating(function ($hero) {
            if (!$hero->id) {
                $hero->id = (string) Str::uuid();
            }
        });

        // Hapus gambar saat record dihapus
        static::deleting(function ($hero) {
            if ($hero->gambar) {
                $path = public_path('uploads/hero/' . $hero->gambar);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        });
    }

    // CREATE
    public static function createHero($data)
    {
        return self::create([
            'gambar' => $data['gambar'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    // UPDATE
    public function updateHero($data)
    {
        return $this->update([
            'gambar' => $data['gambar'] ?? $this->gambar,
            'status' => $data['status'] ?? $this->status,
        ]);
    }

    // DELETE (manual trigger + hapus cache opsional)
    public function deleteHero()
    {
        // Hapus data (event deleting otomatis akan hapus file)
        return $this->delete();
    }

    public static function getActiveHeroImage()
    {
        $hero = self::where('status', 1)->first();
        return $hero && $hero->gambar
            ? asset('uploads/hero/' . $hero->gambar)
            : asset('images/hero-bg1.jpeg');
    }
}
