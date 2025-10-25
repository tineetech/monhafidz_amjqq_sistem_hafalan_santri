<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalHafalanSeeder extends Seeder
{
    /**
     * Jalankan seeder jadwal hafalan.
     */
    public function run(): void
    {
        // Jadwal Ziyadah: Senin - Selasa - Rabu - Kamis - Sabtu
        $ziyadahDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Sabtu'];

        foreach ($ziyadahDays as $day) {
            DB::table('jadwal_hafalan')->insert([
                'jenis_hafalan' => 'ziyadah',
                'hari' => $day,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => null,
                'pembimbing_putra_id' => 1, // Ustadz Sabiq Mujahid
                'pembimbing_putri_id' => 2, // Ustadzah Nuraisyah
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Jadwal Murajaah: Sabtu - Senin - Selasa - Rabu - Kamis
        $murajaahDays = ['Sabtu', 'Senin', 'Selasa', 'Rabu', 'Kamis'];

        foreach ($murajaahDays as $day) {
            DB::table('jadwal_hafalan')->insert([
                'jenis_hafalan' => 'murajaah',
                'hari' => $day,
                'jam_mulai' => '18:30:00',
                'jam_selesai' => null,
                'pembimbing_putra_id' => 1, // Ustadz Sabiq Mujahid
                'pembimbing_putri_id' => 2, // Ustadzah Nuraisyah
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
