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
        Schema::create('ustadzah', function (Blueprint $table) {
            $table->id();

            // Data pribadi
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nik')->unique()->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Kontak & alamat
            $table->text('alamat_lengkap')->nullable();
            $table->string('no_hp', 20)->nullable();

            // Status (misal aktif/nonaktif atau santri/guru)
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ustadzah');
    }
};