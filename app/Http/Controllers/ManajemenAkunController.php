<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenAkunController extends Controller
{
    /**
     * Tampilkan daftar seluruh akun pengguna.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('pages.manage-akun.index', compact('users'));
    }

    /**
     * Tampilkan form tambah akun baru.
     */
    public function create()
    {
        return view('pages.manage-akun.create');
    }

    /**
     * Simpan akun baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'role'     => 'required|string',
            'status'   => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $validated['name'],
            'username'     => $validated['username'],
            'email'    => $validated['email'],
            'role'     => $validated['role'],
            'status'   => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('manage-akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail akun tertentu (opsional).
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.manage-akun.show', compact('user'));
    }

    /**
     * Tampilkan form edit akun.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.manage-akun.edit', compact('user'));
    }

    /**
     * Update data akun.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|string',
            'status'   => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->update([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'role'     => $validated['role'],
            'status'   => $validated['status'],
            'password' => $validated['password']
                ? Hash::make($validated['password'])
                : $user->password,
        ]);

        return redirect()->route('manage-akun.index')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Hapus akun dari database.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage-akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}