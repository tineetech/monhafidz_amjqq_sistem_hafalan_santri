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
}