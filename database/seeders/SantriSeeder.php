<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        $santri = [
            'Ahmad Fathur Rahman',
            'Muhammad Yusuf',
            'Abdullah Al Hafidz',
            'Rizky Maulana',
            'Syamil Akbar',
            'Nabila Zahra',
            'Aisyah Humaira',
            'Nurul Qolbi',
            'Siti Maryam',
            'Fatimah Azzahra'
        ];

        foreach ($santri as $nama) {
            DB::table('santri')->insert([
                'nama_lengkap' => $nama,
                'jenis_kelamin' => Str::contains($nama, ['Nabila','Aisyah','Nurul','Siti','Fatimah']) ? 'Perempuan' : 'Laki-laki',
                'nik' => rand(1000000000000000, 9999999999999999),
                'tanggal_lahir' => now()->subYears(rand(10,18))->subDays(rand(1,300)),
                'alamat_lengkap' => 'Desa Muslimin RT '.rand(1,15).' RW '.rand(1,10),
                'no_hp' => '08'.rand(10000000000, 99999999999),
                'semester_id' => 1,
                'total_juz_tercapai' => rand(0,30),
                'status_santri' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
