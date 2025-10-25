<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ustadz Sabiq Mujahid',
                'username' => 'ustadsabiq',
                'email' => 'ustadsabiq@gmail.com',
                'role' => 'ustad',
                'password' => Hash::make('ustad123'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ustadzah Nuraisyah',
                'username' => 'ustadnuraisyah',
                'email' => 'ustadnuraisyah@gmail.com',
                'role' => 'ustad',
                'password' => Hash::make('ustad123'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Santri Ali',
                'username' => 'santri1',
                'email' => 'santriali@gmail.com',
                'role' => 'santri',
                'password' => Hash::make('santri123'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wali Santri Ali',
                'username' => 'walisantriali',
                'email' => 'walisantriali@gmail.com',
                'role' => 'walisantri',
                'password' => Hash::make('wali123'),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
