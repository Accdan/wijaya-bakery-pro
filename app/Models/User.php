<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Jika kamu ingin primary key tipe string UUID
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'no_telepon',
        'password',
        'profile_picture',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Kalau Laravel 9 ke atas, 'password' bisa otomatis di-hash via cast
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->id) {
                $user->id = (string) Str::uuid();
            }
        });
    }

    // Override supaya Laravel pakai 'username' sebagai identifier login
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
