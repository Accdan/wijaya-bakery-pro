<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuTranslation extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['menu_id', 'lang', 'nama_menu', 'deskripsi_menu', 'prosedur'];
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = $model->id ?? Str::uuid()->toString();
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
