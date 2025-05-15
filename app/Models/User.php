<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->id) {
                $user->id = (string) Str::uuid();
            }
        });
    }

    public static function createPengguna($data)
    {
        return self::create([
            'name'            => $data['name'],
            'username'        => $data['username'],
            'email'           => $data['email'],
            'no_telepon'      => $data['no_telepon'],
            'password'        => bcrypt($data['password']),
            'profile_picture' => $data['profile_picture'] ?? null,
            'role_id'         => $data['role_id'],
        ]);
    }

    public function updatePengguna($data)
    {
        return $this->update([
            'name'            => $data['name'] ?? $this->name,
            'username'        => $data['username'] ?? $this->username,
            'email'           => $data['email'] ?? $this->email,
            'no_telepon'      => $data['no_telepon'] ?? $this->no_telepon,
            'profile_picture' => $data['profile_picture'] ?? $this->profile_picture,
            'role_id'         => $data['role_id'] ?? $this->role_id,
        ]);
    }

    public function deletePengguna()
    {
        return $this->delete();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
