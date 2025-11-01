<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'santri';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'tanggal_lahir',
        'alamat_lengkap',
        'no_hp',
        'semester_id',
        'orang_tua_id',
        'total_juz_tercapai',
        'status_santri',
    ];

    // Format tanggal otomatis jadi Carbon instance
    protected $dates = ['tanggal_lahir'];

    /**
     * Relasi: Santri milik satu Semester
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Relasi: Santri milik satu wali
     */
    // Santri.php
    public function wali()
    {
        return $this->hasOne(WaliSantri::class);
    }

    // app/Models/Santri.php
    public function pencatatanHafalan()
    {
        return $this->hasMany(PencatatanHafalan::class, 'santri_id');
    }

    public function getProgresHafalanAttribute()
    {
        $semester = $this->semester;

        if (!$semester) {
            return [
                'total_ziyadah' => 0, 'persentase_ziyadah' => 0, 'rata_rata_ziyadah' => 0,
                'total_murajaah' => 0, 'persentase_murajaah' => 0, 'rata_rata_murajaah' => 0,
            ];
        }

        // Ambil semua pencatatan di semester itu
        $catatan = $this->pencatatanHafalan()
            ->where('semester_id', $semester->id)
            ->get();

        if ($catatan->isEmpty()) {
            return [
                'total_ziyadah' => 0, 'persentase_ziyadah' => 0, 'rata_rata_ziyadah' => 0,
                'total_murajaah' => 0, 'persentase_murajaah' => 0, 'rata_rata_murajaah' => 0,
            ];
        }

        /* ======================= ZIYADAH ======================= */
        $ziyadah = $catatan->where('jenis_hafalan', 'Ziyadah');

        $totalZ = $ziyadah->sum('juz_tercapai');
        $targetZ = 5;
        $persentaseZ = $targetZ > 0 ? ($totalZ / $targetZ) * 100 : 0;

        $avgTajwidZ = $ziyadah->avg('nilai_tajwid') ?? 0;
        $avgKelancaranZ = $ziyadah->avg('nilai_kelancaran') ?? 0;
        $rataZ = ($avgTajwidZ + $avgKelancaranZ) / 2;

        /* ======================= MURAJAAH ======================= */
        $murajaah = $catatan->where('jenis_hafalan', 'Murajaah');

        $totalM = $murajaah->sum('juz_tercapai');
        $targetM = 10;
        $persentaseM = $targetM > 0 ? ($totalM / $targetM) * 100 : 0;

        $avgTajwidM = $murajaah->avg('nilai_tajwid') ?? 0;
        $avgKelancaranM = $murajaah->avg('nilai_kelancaran') ?? 0;
        $rataM = ($avgTajwidM + $avgKelancaranM) / 2;

        return [
            // Ziyadah
            'total_ziyadah'        => $totalZ,
            'target_ziyadah'       => $targetZ,
            'persentase_ziyadah'   => round($persentaseZ, 2),
            'rata_rata_ziyadah'    => round($rataZ, 2),

            // Murajaah
            'total_murajaah'       => $totalM,
            'target_murajaah'      => $targetM,
            'persentase_murajaah'  => round($persentaseM, 2),
            'rata_rata_murajaah'   => round($rataM, 2),
        ];
    }



}