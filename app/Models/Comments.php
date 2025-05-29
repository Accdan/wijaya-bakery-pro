<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comments extends Model
{
    protected $table = 'comments';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'menu_id',
        'comment',
    ];

    protected static function booted()
    {
        static::creating(function ($comment) {
            if (!$comment->id) {
                $comment->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public static function createComment($data)
    {
        return self::create([
            'user_id'  => $data['user_id'],
            'menu_id'  => $data['menu_id'],
            'comment'  => $data['comment'],
        ]);
    }

    public function updateComment($data)
    {
        return $this->update([
            'comment' => $data['comment'] ?? $this->comment,
        ]);
    }

    public function deleteComment()
    {
        return $this->delete();
    }
}
