<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiVisualController extends Controller
{
    public function index()
    {
        $siswa_id = Auth::user()->userable->id; // id siswa yg login
        $kelas_id = Auth::user()->userable->kelas_id;

        $presensi = Presensi::with('pertemuan.pembelajaran.kelas')
            ->where('siswa_id', $siswa_id)
            ->orderBy('created_at', 'desc')
            ->whereNotNull('nilai')
            ->paginate(7);

        // $labels = $presensi->getCollection()->map(function ($item) {
        //     return  [
        //         $item->pertemuan->pembelajaran->kelas->nama_kelas,
        //         $item->pertemuan->pembelajaran->mapel->nama_mapel
        //     ];
        // });



        $pertemuan = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel', 'pembelajaran.guru', 'presensi'])
            ->orderBy('created_at', 'desc')
            ->whereRelation('pembelajaran', 'kelas_id', $kelas_id)
            ->whereHas('presensi', function ($query) use ($siswa_id) {
                $query->where('siswa_id', $siswa_id)
                    ->whereNotNull('nilai');
            })
            ->paginate(7);

        $data = $pertemuan->getCollection()->map(function ($p) use ($siswa_id) {
            return optional($p->presensi->where('siswa_id', $siswa_id)->first())->nilai;
        });


        $labels = $pertemuan->getCollection()->map(function ($item) {
            return  [
                $item->pembelajaran->kelas->nama_kelas,
                $item->pembelajaran->mapel->nama_mapel
            ];
        });



        return view('siswa.nilai', [
            'presensi' => $presensi,
            'data' => $data,
            'labels' => $labels,
            'pertemuan' => $pertemuan

        ]);
    }

    public function showDetails(string $id)
    {
        // Dapatkan data user yang login
        $kelas_id = Auth::user()->userable->kelas_id;

        // Ambil data pertemuan yang diklik
        $pertemuan = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel', 'pembelajaran.guru'])
            ->findOrFail($id);

        $nama_siswa = Presensi::with('siswa')
            ->where('pertemuan_id', $id)
            ->whereRelation('siswa', 'kelas_id', $kelas_id)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->siswa->nama,
                    'nilai' => $item->nilai
                ];
            });
        $labels = $nama_siswa->pluck('nama');
        $data = $nama_siswa->pluck('nilai');

        //Siswa yang hadir
        $siswa_hadir = Presensi::with(['siswa'])
            ->where('pertemuan_id', $id)
            ->whereRelation('siswa', 'kelas_id', $kelas_id)
            ->where('status', 'hadir')->count();


        //text graph
        $mapel = $pertemuan->pembelajaran->mapel->nama_mapel;
        $materi = $pertemuan->materi;
        $kelas = $pertemuan->pembelajaran->kelas->nama_kelas;


        return view('siswa.details_nilai', [
            'pertemuan' => $pertemuan,
            'nama' => $labels,
            'nilai' => $data,
            'mapel' => $mapel,
            'materi' => $materi,
            'kelas' => $kelas,
            'siswa_hadir' => $siswa_hadir,

        ]);
    }
}
