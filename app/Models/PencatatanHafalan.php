<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanHafalan extends Model
{
    use HasFactory;

    protected $table = "pencatatan_hafalan";
    protected $fillable = [
        'santri_id',
        'semester_id',
        'tanggal',
        'jenis_hafalan',
        'surah_ayat',
        'nilai_tajwid',
        'nilai_kelancaran',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nilai_tajwid' => 'float',
        'nilai_kelancaran' => 'float',
    ];

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    // Relasi ke Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}