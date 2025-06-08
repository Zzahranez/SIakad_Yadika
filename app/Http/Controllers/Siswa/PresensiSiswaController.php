<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiSiswaController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->userable;
        $kelasId = $siswa->kelas_id;

        $pembelajarans = Pembelajaran::with([
            'mapel',
            'guru',
            'pertemuan.presensi' => function ($query) use ($siswa) {
                $query->where('siswa_id', $siswa->id);
            }
        ])->where('kelas_id', $kelasId)->get()->map(function ($pb) {
            // Hitung statistik presensi
            $presensi = $pb->pertemuan->flatMap->presensi;

            $pb->hadir = $presensi->where('status', 'hadir')->count();
            $pb->alpa = $presensi->where('status', 'alpa')->count();
            $pb->izin = $presensi->where('status', 'izin')->count();

            return $pb;
        });


        return view('siswa.presensisiswa', [
            'pembelajaran' => $pembelajarans,
        ]);
    }

    public function detailPresensi(string $pembelajaranId)
    {
        $siswa = Auth::user()->userable;


        $pembelajaran = Pembelajaran::with([
            'pertemuan.presensi.siswa'
        ])->findOrFail($pembelajaranId);


        if ($pembelajaran->kelas_id !== $siswa->kelas_id) {
            abort(403, 'Access denied');
        }

        $totalPertemuan = $pembelajaran->pertemuan->count();

        // Kumpulkan semua presensi di semua pertemuan
        $allPresensi = $pembelajaran->pertemuan->flatMap(fn($p) => $p->presensi);

        // Kelompokkan presensi berdasarkan siswa_id
        $presensiPerSiswa = $allPresensi->groupBy('siswa_id')->map(function ($presensiSiswa) {
            return [
                'hadir' => $presensiSiswa->where('status', 'hadir')->count(),
                'alpa' => $presensiSiswa->where('status', 'alpa')->count(),
                'izin' => $presensiSiswa->where('status', 'izin')->count(),
                'nama' => $presensiSiswa->first()->siswa->nama ?? 'Nama Tidak Diketahui',
            ];
        });

        // Ambil semua presensi per pertemuan
        return view('siswa.presensisiswa.detailspresensi', compact(
            'pembelajaran',
            'totalPertemuan',
            'presensiPerSiswa'
        ));
    }
}
