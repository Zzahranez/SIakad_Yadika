<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Psy\VarDumper\Presenter;

class Siswa extends Model
{
    //
    use HasFactory;

    protected $table = "siswa";

    protected $fillable = [
        'nama',
        'nis_nisn',
        'tanggal_lahir',
        "jenis_kelamin",
        'kelas_id',
        'alamat',
        'no_telp',
        'tahun_masuk',
        'foto_profile',
        'status',
    ];

    // Relasi Siswa Ke kelas One To Many
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    // Relasi ke user
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    // Siswa bisa dimiliki oleh banyak presensi
    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
}
