<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\PencatatanHafalan;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santri = Santri::all();
        $semesters = Semester::all();
        return view('pages.laporan.index', compact('santri', 'semesters'));
    }

    public function chartZiyadah()
    {
        $semesters = Semester::orderBy('id')->get();
        $santri = Santri::all();

        $datasets = [];

        foreach ($santri as $s) {
            $data = [];

            foreach ($semesters as $semester) {
                $total = $s->pencatatanHafalan()
                    ->where('semester_id', $semester->id)
                    ->where('jenis_hafalan', 'ziyadah')
                    ->sum('juz_tercapai');

                $data[] = $total;
            }

            $datasets[] = [
                'label' => $s->nama_lengkap,
                'data'  => $data,
                'borderColor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'fill'  => false,
                'tension' => 0.3
            ];
        }

        return response()->json([
            'labels' => $semesters->pluck('nama_semester'),
            'datasets' => $datasets
        ]);
    }

    public function getLaporanHafalan(Request $request)
    {
        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            return response()->json(['message' => 'Santri tidak ditemukan'], 404);
        }
        
        $jenis_hafalan = $request->jenis_hafalan;
        $target = $jenis_hafalan === 'Ziyadah' ? 5 : 10;

        $pembimbing = Ustadzah::where('nama_lengkap', $santri->jenis_kelamin == 'Laki-laki' ? 'Ustadz Sabiq mujahid' : 'Ustadzah Nuraisyah')->first();
        // Ambil semester
        $semester = Semester::where('nama_semester', $request->semester)->first();
        if (!$semester) {
            return response()->json(['message' => 'Semester tidak ditemukan'], 404);
        }

        // generate bulan dari periode_mulai → periode_selesai
        $start = \Carbon\Carbon::parse($semester->periode_mulai)->startOfMonth();
        $end   = \Carbon\Carbon::parse($semester->periode_selesai)->startOfMonth();

        $months = [];
        while ($start <= $end) {
            $months[] = $start->translatedFormat('F Y'); // Contoh: Januari 2025
            $start->addMonth();
        }

        // Ambil hafalan bulan per bulan
        $data = [];
        foreach ($months as $m) {
            $bulan = \Carbon\Carbon::parse($m)->month;
            $tahun = \Carbon\Carbon::parse($m)->year;

            // contoh: ambil data hafalan santri per bulan
            $result = PencatatanHafalan::where('santri_id', $santri->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->where('jenis_hafalan', $request->jenis_hafalan)
                ->get();

            $resultAll = PencatatanHafalan::where('santri_id', $santri->id)
                ->where('jenis_hafalan', $request->jenis_hafalan)
                ->get();

            $jumlahJuz = $result->sum('juz_tercapai');
            $jumlahJuzAll = $resultAll->sum('juz_tercapai');

            $data[] = [
                'bulan' => $m,
                'surah_juz' => $result->pluck('surah_ayat')->implode(', ') ?: '-',
                'jumlah_juz' => $jumlahJuz,
                'target' => $target ?: 0,
                'persentase' => $jumlahJuz && $target
                    ? round(($jumlahJuz / $target) * 100, 2)
                    : 0,
                'persentase_all' => $jumlahJuzAll && $target
                    ? round(($jumlahJuzAll / $target) * 100, 2)
                    : 0,
                'nilai' => ($result->avg('nilai_tajwid') + $result->avg('nilai_kelancaran')) / 2 ?: '-',
                'keterangan' => $result->pluck('keterangan')->implode(', ') ?: '-',
            ];
        }

        return response()->json([
            'santri' => $santri,
            'pembimbing' => $pembimbing ? $pembimbing->nama_lengkap : 'Tidak ada pembimbing',
            'semester' => $request->semester,
            'jenis_hafalan' => $request->jenis_hafalan,
            'periode' => $semester->periode_mulai . ' s/d ' . $semester->periode_selesai,
            'data' => $data
        ]);
    }
    
    public function exportPdf(Request $request)
    {
        $santri = Santri::find($request->santri_id);
        if (!$santri) return abort(404, "Santri tidak ditemukan");

        $jenis_hafalan = $request->jenis_hafalan;
        $target = $jenis_hafalan === 'Ziyadah' ? 5 : 10;

        $semester = Semester::where('nama_semester', $request->semester)->first();
        if (!$semester) return abort(404, "Semester tidak ditemukan");

        $pembimbing = Ustadzah::where(
            'nama_lengkap',
            $santri->jenis_kelamin == 'Laki-laki'
            ? 'Ustadz Sabiq mujahid'
            : 'Ustadzah Nuraisyah'
        )->first();

        $start = Carbon::parse($semester->periode_mulai)->startOfMonth();
        $end   = Carbon::parse($semester->periode_selesai)->startOfMonth();

        $months = [];
        while ($start <= $end) {
            $months[] = $start->translatedFormat('F Y');
            $start->addMonth();
        }

        $data = [];
        foreach ($months as $m) {
            $bulan = Carbon::parse($m)->month;
            $tahun = Carbon::parse($m)->year;

            $result = PencatatanHafalan::where('santri_id', $santri->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->get();

            $resultAll = PencatatanHafalan::where('santri_id', $santri->id)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->get();

            $jumlahJuz = $result->sum('juz_tercapai');
            $jumlahJuzAll = $resultAll->sum('juz_tercapai');

            $data[] = [
                'bulan' => $m,
                'surah_juz' => $result->pluck('surah_ayat')->implode(', ') ?: '-',
                'jumlah_juz' => $jumlahJuz,
                'persentase' => $jumlahJuz && $target ? round(($jumlahJuz / $target) * 100, 2) : 0,
                'persentase_all' => $jumlahJuzAll && $target ? round(($jumlahJuzAll / $target) * 100, 2) : 0,
                'nilai' => ($result->avg('nilai_tajwid') + $result->avg('nilai_kelancaran')) / 2 ?: '-',
                'keterangan' => $result->pluck('keterangan')->implode(', ') ?: '-',
            ];
        }

        $pdf = Pdf::loadView('pdf.laporan-hafalan', [
            'santri' => $santri,
            'jenis_hafalan' => $jenis_hafalan,
            'semester' => $semester,
            'pembimbing' => $pembimbing ? $pembimbing->nama_lengkap : '-',
            'data' => $data,
            'target' => $target
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan Hafalan - {$santri->nama_lengkap}.pdf");
    }

        
    public function laporanAbsensi(Request $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'jenis_laporan' => 'required|in:hari,bulan',
            'tanggal' => 'required|date'
        ]);

        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            return response()->json(['error' => 'Santri tidak ditemukan'], 404);
        }

        $tanggal = Carbon::parse($request->tanggal);

        // Ambil data absensi sesuai jenis laporan
        if ($request->jenis_laporan == 'hari') {
            $absensi = Absensi::where('santri_id', $santri->id)
                ->whereDate('tanggal', $tanggal)
                ->select(
                    DB::raw("DATE_FORMAT(tanggal, '%d-%m-%Y') as tanggal"),
                    DB::raw("MONTHNAME(tanggal) as bulan"),
                    DB::raw("SUM(status = 'Hadir') as hadir"),
                    DB::raw("SUM(status = 'Izin') as izin"),
                    DB::raw("SUM(status = 'Sakit') as sakit"),
                    DB::raw("SUM(status = 'Alpa') as alpa")
                )
                ->groupBy('tanggal')
                ->get();
            
            $periode = $tanggal->format('d F Y');
        } else {
            // laporan bulanan

            // Ambil semua tanggal dalam bulan
            $start = $tanggal->copy()->startOfMonth();
            $end = $tanggal->copy()->endOfMonth();

            $rangeTanggal = [];
            for ($date = $start; $date <= $end; $date->addDay()) {
                $rangeTanggal[] = $date->format('Y-m-d');
            }

            // Ambil absensi dari DB
            $absensiDB = Absensi::where('santri_id', $santri->id)
                ->whereMonth('tanggal', $tanggal->month)
                ->whereYear('tanggal', $tanggal->year)
                ->get()
                ->keyBy('tanggal');

            // Gabungkan semua hari
            $absensi = [];
            foreach ($rangeTanggal as $tgl) {
                // $record = $absensiDB->get($tgl);
                $record = $absensiDB->get($tgl . " 00:00:00");


                $absensi[] = [
                    'tanggal' => Carbon::parse($tgl)->format('d-m-Y'),
                    'bulan'   => Carbon::parse($tgl)->format('F'),
                    'rangeTgl'  => $rangeTanggal,
                    'tgl'  => $tgl,
                    'hadir'   => $record && $record->status == 'Hadir' ? 1 : 0,
                    'izin'    => $record && $record->status == 'Izin' ? 1 : 0,
                    'sakit'   => $record && $record->status == 'Sakit' ? 1 : 0,
                    'alpa' => $record && $record->status == 'Alpa' ? 1 : 0,
                    'keterangan' => $record ? $record->catatan : null,
                ];
            }

            $periode = $tanggal->format('F Y');
        }

        return response()->json([
            'santri' => [
                'nama_lengkap' => $santri->nama_lengkap
            ],
            'periode' => $periode,
            'pembimbing' => $santri->pembimbing ?? '-',
            'data' => $absensi
        ]);
    }
}
