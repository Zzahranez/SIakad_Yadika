<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class PresensiDanNilaiController extends Controller
{
    public function index()
    {
        $guru_id = Auth::user()->userable->id;
        $pembelajaran = $this->getPembelajaran($guru_id);

        return view('guru.presensidannilai', [
            'pembelajaran' => $pembelajaran['pembelajaran'],

        ]);
    }

    public function getPembelajaran($id)
    {
        $pembelajaran = Pembelajaran::with(['kelas', 'mapel', 'pertemuan'])
            ->where('guru_id', $id)
            ->get();
        $pembelajaran->each(function ($item) {
            $item->total_pertemuan = $item->pertemuan->count();
        });
        return [
            'pembelajaran' => $pembelajaran,
        ];
    }

    public function show($id)
    {
        $guru_id = Auth::user()->userable->id;
        $pembelajaran = Pembelajaran::with(['kelas.siswa', 'mapel', 'pertemuan.presensi'])
            ->where('guru_id', $guru_id)
            ->findOrFail($id);

        // Total pertemuan
        $totalPertemuan = $pembelajaran->pertemuan->count();

        // Ambil siswa dari kelas terkait
        $siswaList = $pembelajaran->kelas->siswa;

        // Persiapkan statistik presensi per siswa
        $presensiPerSiswa = [];
        $totalHadir = 0;
        $totalIzin = 0;
        $totalAlpa = 0;

        foreach ($siswaList as $siswa) {
            $hadir = 0;
            $alpa = 0;
            $izin = 0;
            $nilai = 0;

            $totalNilai = 0;
            $jumlahNilai = 0;

            foreach ($pembelajaran->pertemuan as $pertemuan) {
                $presensi = $pertemuan->presensi->firstWhere('siswa_id', $siswa->id);

                if ($presensi->status == 'hadir') {
                    $hadir++;
                } elseif ($presensi->status == 'izin') {
                    $izin++;
                } elseif ($presensi->status == 'alpa') {
                    $alpa++;
                }

                if ($presensi && is_numeric($presensi->nilai)) {
                    $totalNilai += $presensi->nilai;
                    $jumlahNilai++;
                }
            }

            $totalHadir += $hadir;
            $totalIzin += $izin;
            $totalAlpa += $alpa;

            $rataRataNilai = $jumlahNilai > 0 ? round($totalNilai / $jumlahNilai, 2) : null;

            $presensiPerSiswa[$siswa->id] = [
                'nama' => $siswa->nama,
                'hadir' => $hadir,
                'izin' => $izin,
                'alpa' => $alpa,
                'nilai' => $nilai,
                'totalNilai' => $totalNilai,
                'rata-rata' => $rataRataNilai,
            ];
        }

        


        return view('guru.presensidannilai.details_presensi_dan_nilai', [
            'pembelajaran' => $pembelajaran,
            'totalPertemuan' => $totalPertemuan,
            'presensiPerSiswa' => $presensiPerSiswa,
            'totalSiswaHadir' => $totalHadir,
            'totalSiswaAlpa' => $totalAlpa,
            'totalSiswaIzin' => $totalIzin,
        ]);
    }
}
