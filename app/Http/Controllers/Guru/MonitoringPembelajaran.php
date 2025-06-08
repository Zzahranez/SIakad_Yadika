<?php
namespace App\Http\Controllers\Guru;  // Harus ada

use App\Http\Controllers\Controller;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringPembelajaran extends Controller
{
    public function index(){
        $guru_login = Auth::user()->userable;
        $jadwal_ngajar = Pembelajaran::with(['kelas', 'mapel'])->where('guru_id', $guru_login->id)->get();

        return view('guru.monitoringpresensi',[
            'guru_mengajar' => $jadwal_ngajar,
        ]); 
    }

    public function store(Request $request){

        $pertemuan = Pertemuan::create([
            'pembelajaran_id' => $request->kelas_mapel,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'materi' => $request->materi,
        ]);

            return redirect()->route('DetailPresensi.index', $pertemuan->id);
    }
}
