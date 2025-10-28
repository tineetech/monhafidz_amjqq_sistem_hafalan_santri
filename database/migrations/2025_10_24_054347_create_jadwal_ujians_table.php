<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ujian', function (Blueprint $table) {
            $table->id();

            // Relasi ke santri
            $table->foreignId('santri_id')
                  ->constrained('santri')
                  ->onDelete('cascade');

            // Hari ujian (misalnya Senin, Selasa, dst)
            $table->date('tanggal');
            $table->string('hari', 20);

            // Waktu ujian
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // Pembimbing / Penilai
            $table->foreignId('pembimbing_putra_id')
                  ->nullable()
                  ->constrained('ustadzah') // jika tabel ustadz dan ustadzah digabung, gunakan ini
                  ->onDelete('set null');

            $table->foreignId('pembimbing_putri_id')
                  ->nullable()
                  ->constrained('ustadzah')
                  ->onDelete('set null');

            // Jenis ujian
            $table->enum('jenis_ujian', ['tasmi', 'ujian_akhir'])->default('tasmi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujians');
    }
};