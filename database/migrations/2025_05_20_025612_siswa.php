<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis_nisn')->unique();
            $table->date('tanggal_lahir');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat')->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->year('tahun_masuk');
            $table->string('foto_profile')->nullable();
            // $table->string('nama_ayah')->nullable();
            // $table->string('nama_ibu')->nullable();
            // $table->string('no_telp_ortu', 15)->nullable();
            // $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            // $table->string('email')->nullable();
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'dikeluarkan'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
