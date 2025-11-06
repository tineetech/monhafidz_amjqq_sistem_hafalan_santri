<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    
    public function generate30Juz(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|string',
            'nama_ustad' => 'nullable|string',
        ]);

        $idSantri = $request->query('id_santri');
        $santri = Santri::where('id', $idSantri)->where('total_juz_tercapai', '>=', 30)->firstOrFail();

        $namaSantri = $santri->nama_lengkap;
        $tanggal    = now()->format('d F Y');
        $namaUstad  = $request->query('nama_ustad') ?? 'Ust. Sabiq Mujahid N';

        $pdf = Pdf::loadView('pdf.tahfidz30juz', compact(
            'namaSantri', 'tanggal', 'namaUstad'
        ))->setPaper('legal', 'landscape')
          ->setOption(['chroot' => public_path(), 'isFontSubsettingEnabled' => true, 'fontCache' => public_path('fonts')]);

        return $pdf->stream("Sertifikat-$namaSantri.pdf");
    }
}
