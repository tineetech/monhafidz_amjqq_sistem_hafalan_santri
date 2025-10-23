<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencatatan_hafalan', function (Blueprint $table) {
            $table->id();

            // Relasi utama
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('semester_id')->nullable()->constrained('semester')->onDelete('set null');

            // Data hafalan
            $table->date('tanggal');
            $table->enum('jenis_hafalan', ['Ziyadah', 'Murajaah']);
            $table->string('surah_ayat')->nullable(); // contoh: "Al-Baqarah: 1–10"
            $table->decimal('nilai_tajwid', 5, 2)->nullable();
            $table->decimal('nilai_kelancaran', 5, 2)->nullable();
            $table->text('catatan')->nullable();

            // Status penilaian
            $table->enum('status', ['Belum Diperiksa', 'Lulus', 'Perbaikan'])->default('Belum Diperiksa');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencatatan_hafalan');
    }
};