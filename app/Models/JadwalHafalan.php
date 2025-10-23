<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHafalan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_hafalan';

    protected $fillable = [
        'jenis_hafalan',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'pembimbing_putra_id',
        'pembimbing_putri_id',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    /**
     * Relasi ke ustadzah (pembimbing putra)
     */
    public function pembimbingPutra()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putra_id');
    }

    /**
     * Relasi ke ustadzah (pembimbing putri)
     */
    public function pembimbingPutri()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putri_id');
    }
}