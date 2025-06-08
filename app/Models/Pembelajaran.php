<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Pembelajaran extends Model
{
    //
    use HasFactory;

    protected $table = 'pembelajaran';
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
    ];

    // Dimiliki kelas
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    // Dimiliki Mapel
    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }
    // Dimiliki guru
    public function guru(){
        return $this->belongsTo(Guru::class);
    }
    public function pertemuan(){
        return $this->hasMany(Pertemuan::class);
    }
}
