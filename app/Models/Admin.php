<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Admin extends Model
{
    //
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'foto_profile',
        'status',
        'tanggal_lahir',
        'no_telp'
    ];

    public function user() : MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function pengumuman(){
        return $this->hasMany(Pengumuman::class);
    }
}
