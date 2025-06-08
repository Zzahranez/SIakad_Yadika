<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = [
        'pertemuan_id',
        'siswa_id',
        'status',
        'nilai',
    ];

    //Tabel ini miliki pertemuan
    public function pertemuan(){
        return $this->belongsTo(Pertemuan::class);
    }

    //Tabel ini milik siswa
    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
