<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santri = Santri::all();
        return view('pages.master.santri.index', compact('santri'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $semesters = \App\Models\Semester::all();

        return view('pages.master.santri.create', compact('semesters'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'semester_id' => 'required|integer',
            'total_juz_tercapai' => 'required|integer',
            'status_santri' => 'required|string',
        ]);

        \App\Models\Santri::create($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        $santri = \App\Models\Santri::findOrFail($id);
        $semesters = \App\Models\Semester::all();

        return view('pages.master.santri.edit', compact('santri', 'semesters'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'semester_id' => 'required|integer',
            'total_juz_tercapai' => 'required|integer',
            'status_santri' => 'required|string',
        ]);

        $santri = \App\Models\Santri::findOrFail($id);
        $santri->update($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santri = \App\Models\Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus!');
    }
}
