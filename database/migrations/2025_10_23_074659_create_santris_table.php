<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();

            // Data pribadi santri
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nik')->unique();
            $table->date('tanggal_lahir');
            $table->string('alamat_lengkap');
            $table->string('no_hp')->nullable();

            // Relasi / informasi tambahan
            $table->foreignId('semester_id')->nullable()->constrained('semester')->onDelete('set null');
           // $table->foreignId('wali_santri_id')->nullable()->constrained('wali_santri')->onDelete('set null');

            // Hafalan dan status
            $table->integer('total_juz_tercapai')->default(0)->comment('Jumlah juz ziyadah yang telah dicapai');
            $table->enum('status_santri', ['Aktif', 'Tidak Aktif', 'Lulus'])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};