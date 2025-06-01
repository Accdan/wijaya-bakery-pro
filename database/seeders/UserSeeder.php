<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate([
            'username' => 'admin123'
        ], [
            'name' => 'Admin Seed',
            'username' => 'admin123',
            'email' => 'admin@example.com',
            'no_telepon' => '0811111111',
            'password' => Hash::make('password'),
            'role_id' => '6ef8fcb8-7bd8-4279-b26b-b06b20b78043',
        ]);

        User::updateOrCreate([
            'username' => 'user123'
        ], [
            'name' => 'User Seed',
            'username' => 'user123',
            'email' => 'user@example.com',
            'no_telepon' => '0822222222',
            'password' => Hash::make('password'),
            'role_id' => '9d758f24-0707-4a9a-84df-8e8bc3e1eaaa',
        ]);

        $this->command->info('UserSeeder: Admin dan user berhasil di-seed.');
    }
}
