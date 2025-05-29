<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IngredientsMenu extends Model
{
    protected $table = 'ingredient_menu';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'menu_id',
        'ingredient_id',
        'jumlah',
        'satuan',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class, 'ingredient_id');
    }
}
