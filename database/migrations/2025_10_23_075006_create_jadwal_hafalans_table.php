<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('jadwal_hafalan', function (Blueprint $table) {
            $table->id();

            // Jenis hafalan: Ziyadah atau Murajaah
            $table->enum('jenis_hafalan', ['ziyadah', 'murajaah']);

            // Hari dan waktu
            $table->string('hari'); // contoh: Senin, Selasa, Rabu
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable(); // boleh null jika “selesai” open

            // Relasi ke ustadzah (pembimbing putra & putri)
            $table->foreignId('pembimbing_putra_id')
                ->nullable()
                ->constrained('ustadzah')
                ->onDelete('set null');

            $table->foreignId('pembimbing_putri_id')
                ->nullable()
                ->constrained('ustadzah')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Undo migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_hafalan');
    }
};