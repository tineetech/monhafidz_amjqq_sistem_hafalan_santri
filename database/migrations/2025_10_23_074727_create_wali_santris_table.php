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
        Schema::create('wali_santri', function (Blueprint $table) {
            $table->id();

            // Data pribadi wali
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nik')->unique()->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Hubungan dengan santri
            $table->string('wali_sebagai')->nullable(); // contoh: Ayah, Ibu, Kakak, Wali Lainnya
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');

            // Kontak dan alamat
            $table->text('alamat_lengkap')->nullable();
            $table->string('no_hp', 20)->nullable();

            // Status
            $table->enum('status_wali', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Undo migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_santri');
    }
};