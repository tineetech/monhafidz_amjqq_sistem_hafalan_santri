<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            // Relasi utama
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('pencatatan_hafalan_id')->nullable()->constrained('pencatatan_hafalan')->onDelete('set null');

            // Data absensi
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Alpa', 'Sakit'])->default('Hadir');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};