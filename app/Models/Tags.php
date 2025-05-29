<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tags extends Model
{
    protected $table = 'tags';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_tag',
    ];

    protected static function booted()
    {
        static::creating(function ($tag) {
            if (!$tag->id) {
                $tag->id = (string) Str::uuid();
            }
        });
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_tag', 'tag_id', 'menu_id');
    }

    public static function createTag($data)
    {
        return self::create([
            'nama_tag' => $data['nama_tag'],
        ]);
    }

    public function updateTag($data)
    {
        return $this->update([
            'nama_tag' => $data['nama_tag'] ?? $this->nama_tag,
        ]);
    }

    public function deleteTag()
    {
        return $this->delete();
    }
}
