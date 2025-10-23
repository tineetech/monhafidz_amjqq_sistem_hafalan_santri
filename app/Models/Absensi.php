<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "absensi";
    protected $fillable = [
        'santri_id',
        'pencatatan_hafalan_id',
        'tanggal',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    // Relasi ke Pencatatan Hafalan
    public function pencatatanHafalan()
    {
        return $this->belongsTo(PencatatanHafalan::class);
    }
}