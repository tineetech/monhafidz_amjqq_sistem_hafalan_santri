<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencatatan_ujian', function (Blueprint $table) {
            $table->id();

            // Relasi ke santri (tanpa "s" di nama tabel)
            $table->foreignId('santri_id')
                  ->nullable()
                  ->constrained('santri')
                  ->onDelete('cascade');

            // Relasi ke ustadzah (penilai)
            $table->foreignId('ustadzah_id')
                  ->nullable()
                  ->constrained('ustadzah')
                  ->onDelete('set null');

            // Jenis ujian: tasmi' atau ujian akhir
            $table->date('tanggal');
            $table->enum('jenis_ujian', ['tasmi', 'ujian_akhir'])->default('tasmi');

            // Nilai akhir ujian (0-100)
            $table->decimal('nilai_akhir', 5, 2)->nullable();

            // Status ujian: belum diuji, lulus, remidi
            $table->enum('status_ujian', ['belum_diuji', 'lulus', 'remidi'])->default('belum_diuji');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencatatan_ujian');
    }
};