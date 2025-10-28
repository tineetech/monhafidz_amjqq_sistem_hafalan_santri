<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('beranda');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/master')->group(function () {
        Route::resource('/santri', App\Http\Controllers\SantriController::class);
        Route::resource('/ustadzah', App\Http\Controllers\UstadController::class);
        Route::resource('/wali', App\Http\Controllers\WaliController::class);
        Route::resource('/semester', App\Http\Controllers\SemesterController::class);
    });

    Route::resource('/jadwal-hafalan', App\Http\Controllers\JadwalHafalanController::class);
    Route::get('/jadwal-hafalan-zm/edit', [App\Http\Controllers\JadwalHafalanController::class, 'editAddon'])->name('jadwal-hafalan.edit');
    Route::put('/jadwal-hafalan-zm/update', [App\Http\Controllers\JadwalHafalanController::class, 'update'])->name('jadwal-hafalan-zm.update');

    Route::resource('/absensi', App\Http\Controllers\AbsensiController::class);
    Route::get('/get-hafalan/{santri_id}', [App\Http\Controllers\AbsensiController::class, 'getHafalan']);

    Route::resource('/pencatatan-hafalan', App\Http\Controllers\PencatatanHafalanController::class);
    Route::resource('/rekap-hafalan', App\Http\Controllers\RekapHafalanController::class);

    Route::resource('/jadwal-ujian', App\Http\Controllers\JadwalUjianController::class);
    Route::resource('/pencatatan-ujian', App\Http\Controllers\PencatatanUjianController::class);
    
    Route::resource('/laporan', App\Http\Controllers\LaporanController::class);

    Route::resource('/manage-akun', App\Http\Controllers\ManajemenAkunController::class);
    Route::resource('/pengaturan', App\Http\Controllers\PengaturanController::class);
    
    
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');