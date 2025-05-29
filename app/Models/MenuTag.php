<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuTag extends Model
{
    protected $table = 'menu_tag';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'menu_id',
        'tag_id',
    ];

    protected static function booted()
    {
        static::creating(function ($menuTag) {
            if (!$menuTag->id) {
                $menuTag->id = (string) Str::uuid();
            }
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tag_id');
    }

    public static function attachTagToMenu($menu_id, $tag_id)
    {
        return self::create([
            'menu_id' => $menu_id,
            'tag_id'  => $tag_id,
        ]);
    }

    public static function detachTagFromMenu($menu_id, $tag_id)
    {
        return self::where('menu_id', $menu_id)
            ->where('tag_id', $tag_id)
            ->delete();
    }
}
