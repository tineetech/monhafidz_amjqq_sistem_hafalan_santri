<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Santri;
use App\Models\PencatatanHafalan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Tampilkan daftar absensi.
     */
    public function index()
    {
        $absensi = Absensi::with(['santri'])->latest()->get();
        return view('pages.absensi.index', compact('absensi'));
    }

    /**
     * Tampilkan form tambah absensi.
     */
    public function create()
    {
        $santri = Santri::all();
        $hafalan = PencatatanHafalan::all();
        return view('pages.absensi.create', compact('santri', 'hafalan'));
    }

    /**
     * Simpan data absensi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'catatan' => 'nullable|string',
        ]);

        Absensi::create($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail absensi tertentu.
     */
    public function show($id)
    {
        $absensi = Absensi::with(['santri'])->findOrFail($id);
        return view('pages.absensi.show', compact('absensi'));
    }

    /**
     * Tampilkan form edit absensi.
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $santri = Santri::all();
        $hafalan = PencatatanHafalan::all();

        return view('pages.absensi.edit', compact('absensi', 'santri', 'hafalan'));
    }

    /**
     * Update data absensi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'catatan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Hapus data absensi.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');
    }

    public function getHafalan($santri_id)
    {
        $hafalan = \App\Models\PencatatanHafalan::where('santri_id', $santri_id)
            ->select('id', 'jenis_hafalan', 'surah_ayat')
            ->get();

        return response()->json($hafalan);
    }

}
