<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
    ];

    // Kelas bisa dimiliki oleh banyak siswa Many to One
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Klas bisa dimiliki oleh banyak pembelajaran Many to one

    public function pembelajaran(){
        return $this->hasMany(Pembelajaran::class);
    }
}
