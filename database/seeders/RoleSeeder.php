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
                'id' => (string) Str::uuid(),
                'role_name' => 'admin',
                'role_description' => 'pengelola',
                'role_status' => 1,
            ],
            [
                'id' => (string) Str::uuid(),
                'role_name' => 'pengguna',
                'role_description' => 'pengunjung',
                'role_status' => 1,
            ],
        ]);
    }
}
