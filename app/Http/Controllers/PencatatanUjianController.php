<?php

namespace App\Http\Controllers;

use App\Models\PencatatanUjian;
use App\Models\Santri;
use App\Models\Ustadzah;
use Illuminate\Http\Request;

class PencatatanUjianController extends Controller
{
    public function index()
    {
        $ujian = PencatatanUjian::with(['santri', 'ustadzah'])->latest()->get();
        return view('pages.pencatatan-ujian.index', compact('ujian'));
    }

    public function create()
    {
        $santri = Santri::all();
        $ustadzah = Ustadzah::all();
        return view('pages.pencatatan-ujian.create', compact('santri', 'ustadzah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'      => 'required|date',
            'santri_id'    => 'required|exists:santri,id',
            'ustadzah_id'  => 'nullable|exists:ustadzah,id',
            'jenis_ujian'  => 'required|in:tasmi,ujian_akhir',
            'nilai_akhir'  => 'nullable|numeric|min:0|max:100',
            'status_ujian' => 'required|in:belum_diuji,lulus,remidi',
        ]);

        PencatatanUjian::create($request->all());

        return redirect()->route('pencatatan-ujian.index')
                         ->with('success', 'Data ujian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ujian = PencatatanUjian::findOrFail($id);
        $santri = Santri::all();
        $ustadzah = Ustadzah::all();
        return view('pages.pencatatan-ujian.edit', compact('ujian', 'santri', 'ustadzah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'      => 'required|date',
            'santri_id'    => 'required|exists:santri,id',
            'ustadzah_id'  => 'nullable|exists:ustadzah,id',
            'jenis_ujian'  => 'required|in:tasmi,ujian_akhir',
            'nilai_akhir'  => 'nullable|numeric|min:0|max:100',
            'status_ujian' => 'required|in:belum_diuji,lulus,remidi',
        ]);

        $ujian = PencatatanUjian::findOrFail($id);
        $ujian->update($request->all());

        return redirect()->route('pencatatan-ujian.index')
                         ->with('success', 'Data ujian berhasil diupdate');
    }

    public function destroy($id)
    {
        $ujian = PencatatanUjian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('pencatatan-ujian.index')
                         ->with('success', 'Data ujian berhasil dihapus');
    }
}
