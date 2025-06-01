<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id' => '6ef8fcb8-7bd8-4279-b26b-b06b20b78043',
                'role_name' => 'admin',
                'role_description' => 'pengelola',
                'role_status' => 1,
            ],
            [
                'id' => '9d758f24-0707-4a9a-84df-8e8bc3e1eaaa',
                'role_name' => 'pengguna',
                'role_description' => 'pengunjung',
                'role_status' => 1,
            ],
        ]);
    }
}
