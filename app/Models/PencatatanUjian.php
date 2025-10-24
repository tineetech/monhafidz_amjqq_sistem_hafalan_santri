<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'ustadzah_id',
        'jenis_ujian',
        'nilai_akhir',
        'status_ujian',
    ];

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    // Relasi ke Ustadzah (penilai)
    public function ustadzah()
    {
        return $this->belongsTo(Ustadzah::class);
    }
}