<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    //
    use HasFactory;

    protected $table = "mapel";

    protected $fillable = [
         "nama_mapel",
    ];
    
    // Mata pelajaran bisa dimiliki dibanyak pembelajaran
    public function pembelajaran(){
        return $this->hasMany(Pembelajaran::class);
    }
}
