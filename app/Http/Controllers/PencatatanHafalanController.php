<?php

namespace App\Http\Controllers;

use App\Models\PencatatanHafalan;
use App\Models\Santri;
use App\Models\Semester;
use Illuminate\Http\Request;

class PencatatanHafalanController extends Controller
{
    /**
     * Tampilkan daftar pencatatan hafalan.
     */
    public function index()
    {
        $data = PencatatanHafalan::with(['santri', 'semester'])->latest()->get();

        return view('pages.pencatatan-hafalan.index', compact('data'));
    }

    /**
     * Form tambah pencatatan hafalan.
     */
    public function create()
    {
        $santri = Santri::all();
        $semester = Semester::all();

        return view('pages.pencatatan-hafalan.create', compact('santri', 'semester'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_hafalan' => 'required|string',
            'surah_ayat' => 'required|string',
            'nilai_tajwid' => 'required|numeric|min:0|max:100',
            'nilai_kelancaran' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        PencatatanHafalan::create($validated);

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil disimpan.');
    }

    /**
     * Detail data hafalan.
     */
    public function show($id)
    {
        $data = PencatatanHafalan::with(['santri', 'semester'])->findOrFail($id);

        return view('pages.pencatatan-hafalan.show', compact('data'));
    }

    /**
     * Form edit pencatatan hafalan.
     */
    public function edit($id)
    {
        $data = PencatatanHafalan::findOrFail($id);
        $santri = Santri::all();
        $semester = Semester::all();

        return view('pages.pencatatan-hafalan.edit', compact('data', 'santri', 'semester'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_hafalan' => 'required|string',
            'surah_ayat' => 'required|string',
            'nilai_tajwid' => 'required|numeric|min:0|max:100',
            'nilai_kelancaran' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $data = PencatatanHafalan::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy($id)
    {
        $data = PencatatanHafalan::findOrFail($id);
        $data->delete();

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil dihapus.');
    }
}
