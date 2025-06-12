<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    protected $table = "pertemuan";
    protected $fillable= [
        'pembelajaran_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'materi',
        'status',
    ];

    // Pertemuan milik tabel pembelajaran
    public function pembelajaran(){
        return $this->belongsTo(Pembelajaran::class);
    }

    // Data tabel ini bisadimiliki oleh banyak table presensi
    public function presensi(){
        return $this->hasMany(Presensi::class);
    }
}
