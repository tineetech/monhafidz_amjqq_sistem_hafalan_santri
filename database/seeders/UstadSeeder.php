<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UstadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ustadzah')->insert([
            [
                'nama_lengkap' => 'Ustad Sabiq mujahid N',
                'jenis_kelamin' => 'Laki-laki',
                'nik' => '939933939',
                'tanggal_lahir' => now(),
                'alamat_lengkap' => 'tasikmalaya',
                'no_hp' => '087737373',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Ustadzah Nuraisyah',
                'jenis_kelamin' => 'Perempuan',
                'nik' => '839933939',
                'tanggal_lahir' => now(),
                'alamat_lengkap' => 'tasikmalaya',
                'no_hp' => '087737373',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
