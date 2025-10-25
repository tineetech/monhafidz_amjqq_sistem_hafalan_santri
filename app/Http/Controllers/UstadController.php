<?php

namespace App\Http\Controllers;

use App\Models\Ustadzah;
use Illuminate\Http\Request;

class UstadController extends Controller
{
    /**
     * Tampilkan daftar ustadzah.
     */
    public function index()
    {
        $ustadzah = Ustadzah::orderBy('nama_lengkap')->get();
        return view('pages.master.ustad.index', compact('ustadzah'));
    }

    /**
     * Tampilkan form tambah ustadzah.
     */
    public function create()
    {
        return view('pages.master.ustad.create');
    }

    /**
     * Simpan data ustadzah baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|numeric|unique:ustadzah,nik',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'status' => 'required|string|max:50',
        ]);

        Ustadzah::create($validated);

        if (!$validated) {
            return redirect()->back()
                ->withErrors('Terjadi kesalahan saat menyimpan data ustadzah.')
                ->withInput();
        }
        return redirect()->route('ustadzah.index')
            ->with('success', 'Data ustadzah berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail ustadzah.
     */
    public function show($id)
    {
        $ustadzah = Ustadzah::findOrFail($id);
        return view('pages.master.ustad.show', compact('ustadzah'));
    }

    /**
     * Tampilkan form edit ustadzah.
     */
    public function edit($id)
    {
        $ustadzah = Ustadzah::findOrFail($id);
        return view('pages.master.ustad.edit', compact('ustadzah'));
    }

    /**
     * Perbarui data ustadzah.
     */
    public function update(Request $request, $id)
    {
        $ustadzah = Ustadzah::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|numeric|unique:ustadzah,nik,' . $ustadzah->id,
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'status' => 'required|string|max:50',
        ]);

        $ustadzah->update($request->all());

        return redirect()->route('ustadzah.index')
            ->with('success', 'Data ustadzah berhasil diperbarui.');
    }

    /**
     * Hapus data ustadzah.
     */
    public function destroy($id)
    {
        $ustadzah = Ustadzah::findOrFail($id);
        $ustadzah->delete();

        return redirect()->route('ustadzah.index')
            ->with('success', 'Data ustadzah berhasil dihapus.');
    }
}
