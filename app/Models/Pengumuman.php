<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = [
        'admin_id', 'title', 'isi',
    ];


    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}

