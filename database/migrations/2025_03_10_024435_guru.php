<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('alamat')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('no_telp')->nullable();
            $table->date('tanggal_lahir');
            $table->enum('status_kepegawaian', ['tetap', 'kontrak', 'honorer']);
            $table->enum('pendidikan_terakhir', ['S1', 'S2', 'S3'])->nullable();
            $table->string('jurusan')->nullable();
            $table->year('tahun_masuk')->nullable();
            $table->string('foto_profile')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
