<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Guru extends Model
{
    //
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        "nama",
        "nip",
        "jenis_kelamin",
        'foto_profile',
        'alamat',

        'no_telp',
        'tanggal_lahir',
        'status_kepegawaian',
        'pendidikan_terakhir',
        'jurusan', //nullable
        'tahun_masuk', //nullable
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    // Guru bisa banyak mengajar
    public function pembelajaran()
    {
        return $this->hasMany(Pembelajaran::class);
    }
}
