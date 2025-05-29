<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ingredients extends Model
{
    protected $table = 'ingredients';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'menu_id',
        'nama_bahan',
        'jumlah',
        'satuan',
    ];

    protected static function booted()
    {
        static::creating(function ($ingredient) {
            if (!$ingredient->id) {
                $ingredient->id = (string) Str::uuid();
            }
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public static function createIngredient($data)
    {
        return self::create([
            'menu_id'     => $data['menu_id'],
            'nama_bahan'  => $data['nama_bahan'],
            'jumlah'      => $data['jumlah'],
            'satuan'      => $data['satuan'],
        ]);
    }

    public function updateIngredient($data)
    {
        return $this->update([
            'nama_bahan' => $data['nama_bahan'] ?? $this->nama_bahan,
            'jumlah'     => $data['jumlah'] ?? $this->jumlah,
            'satuan'     => $data['satuan'] ?? $this->satuan,
        ]);
    }

    public function deleteIngredient()
    {
        return $this->delete();
    }
}
