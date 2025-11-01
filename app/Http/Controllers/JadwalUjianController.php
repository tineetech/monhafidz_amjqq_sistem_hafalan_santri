<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\Santri;
use App\Models\Ustadzah;
use App\Services\MpwaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = JadwalUjian::with(['santri', 'pembimbingPutra', 'pembimbingPutri'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.jadwal-ujian.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santri = Santri::orderBy('nama_lengkap','asc')->get();
        $ustadzah = Ustadzah::orderBy('nama_lengkap','asc')->get();

        return view('pages.jadwal-ujian.create', compact('santri','ustadzah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id'             => 'required|exists:santri,id',
            'tanggal'               => 'required|date',
            'jam_mulai'             => 'required|date_format:H:i',
            'jam_selesai'           => 'required|date_format:H:i|after:jam_mulai',
            'pembimbing_putra_id'   => 'nullable|exists:ustadzah,id',
            'pembimbing_putri_id'   => 'nullable|exists:ustadzah,id',
            'jenis_ujian'           => 'required|in:tasmi,ujian_akhir'
        ]);


        
        $jadwal = JadwalUjian::create($validated);

        // ambil nomor WA santri
        $santri = $jadwal->santri;
        $phone  = $santri->no_hp ?? null;

        if ($phone) {
            $text = "Assalamualaikum, {$santri->nama_lengkap}.\n"
                . "Anda mendapatkan jadwal ujian:\n"
                . "📆 Tanggal : {$jadwal->tanggal}\n"
                . "⏰ Jam     : {$jadwal->jam_mulai} - {$jadwal->jam_selesai}\n"
                . "📝 Jenis   : " . strtoupper($jadwal->jenis_ujian);

            try {
                MpwaService::sendMessage($phone, $text);
            } catch (\Exception $e) {
                Log::error("Gagal kirim WA ke $phone: " . $e->getMessage());
            }
        }


        return redirect()->route('jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalUjian::findOrFail($id);
        $santri = Santri::orderBy('nama_lengkap','asc')->get();
        $ustadzah = Ustadzah::orderBy('nama_lengkap','asc')->get();

        return view('pages.jadwal-ujian.edit', compact('jadwal','santri','ustadzah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'santri_id'             => 'required|exists:santri,id',
            'tanggal'               => 'required|date',
            'jam_mulai'             => 'required|',
            'jam_selesai'           => 'required|after:jam_mulai',
            'pembimbing_putra_id'   => 'nullable|exists:ustadzah,id',
            'pembimbing_putri_id'   => 'nullable|exists:ustadzah,id',
            'jenis_ujian'           => 'required|in:tasmi,ujian_akhir'
        ]);

        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->update($validated);

        // ambil nomor WA santri
        $santri = $jadwal->santri;
        $phone  = $santri->no_hp ?? null;

        if ($phone) {
            $text = "Assalamualaikum, {$santri->nama_lengkap}.\n"
                . "Jadwal ujian anda telah Diperbarui:\n"
                . "📆 Tanggal : {$jadwal->tanggal}\n"
                . "⏰ Jam     : {$jadwal->jam_mulai} - {$jadwal->jam_selesai}\n"
                . "📝 Jenis   : " . strtoupper($jadwal->jenis_ujian);

            try {
                MpwaService::sendMessage($phone, $text);
            } catch (\Exception $e) {
                Log::error("Gagal kirim WA ke $phone: " . $e->getMessage());
            }
        }
        return redirect()->route('jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil dihapus!');
    }
}
