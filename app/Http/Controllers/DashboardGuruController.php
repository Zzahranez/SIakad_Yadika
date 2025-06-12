<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Pengumuman;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
    public function index()
    {
        $nama_user = Auth::user();
        $guru_id = Auth::user()->userable->id;
        $tahunandSemester = $this->getSemesterAndTahun();
        $pengumuman = $this->getPengumuman();

        //StatsCard

        $presentase_kehadiran = $this->getPresentaseKehadiranKelas();
        $rata_rata_nilai = $this->getRataNilaiSiswaPertemuan($guru_id);

        //Grafik
        $nilaipermapel = $this->getNilaiRataSiswaPerMapel($guru_id);
        $trendData = $this->getTrendNilai();

        //Table
        $nilai = $this->getNilaiDanPertemuanTerbaru($guru_id);

        return view("gurudash", [
            'nama_user' => $nama_user,
            'semester' => $tahunandSemester['semester'],
            'tahun_akademik' => $tahunandSemester['tahun_akademik'],
            'presentase_kehadiran' => $presentase_kehadiran,
             'rata_rata_nilai_siswa' => $rata_rata_nilai,
            'pengumuman' => $pengumuman,
            //Grafik
            'labels_pie' => $nilaipermapel->pluck('mapel')->values()->all(),
            'data_pie' => $nilaipermapel->pluck('Rata-rata')->values()->all(),

            'labels_line' => $trendData['labels'],
            'data_line' => $trendData['data'],

            //Tablle
            'nilai' => $nilai,
        ]);
    }

    public function getSemesterAndTahun()
    {
        $hari_ini = Carbon::now();
        $bulan = $hari_ini->month;
        $tahun = $hari_ini->year;

        if ($bulan >= 1 && $bulan < 6) {
            $semester = 'Genap';
            $tahun_akademik = ($tahun - 1) . '/' . ($tahun);
        } else {
            $semester = 'Ganjil';
            $tahun_akademik = ($tahun) . '/' . ($tahun + 1);
        }

        return [
            'semester' => $semester,
            'tahun_akademik' =>  $tahun_akademik
        ];
    }

    public function getPresentaseKehadiranKelas()
    {
        $guru_id = Auth::user()->userable->id;

        $totalPresensi = Presensi::with(['pertemuan.pembelajaran'])
            ->whereRelation('pertemuan', 'status', 'sedang_berlangsung')
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $guru_id)
            ->count();

        $jumlahHadir = Presensi::with('pertemuan.pembelajaran')
            ->whereRelation('pertemuan', 'status', 'sedang_berlangsung')
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $guru_id)
            ->where('status', 'hadir')
            ->count();

        $presentase = $totalPresensi > 0 ? round(($jumlahHadir / $totalPresensi) * 100, 2) : 0;

        return $presentase;
    }

    public function getRataNilaiSiswaPertemuan($guru_id)
    {
        return round(
            Presensi::whereNotNull('nilai')
                ->whereRelation('pertemuan', 'status', 'sedang_berlangsung')
                ->whereRelation('pertemuan.pembelajaran', 'guru_id', $guru_id)
                ->avg('nilai') ?? 0,
            2
        );
    }

    // Grafik
    public function getNilaiRataSiswaPerMapel($id)
    {
        $presensi = Presensi::with(['pertemuan.pembelajaran.mapel'])
            ->whereRelation('pertemuan', 'status', 'sedang_berlangsung')
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $id)
            ->get();

        $perMapel = $presensi->groupBy(function ($item) {
            return $item->pertemuan->pembelajaran->mapel->nama_mapel ?? 'Tidak Diketahui';
        });

        $hasil = $perMapel->map(function ($item, $mapel) {
            $total = $item->sum('nilai');
            $jumlahsiswa = $item->count();

            return [
                'mapel' => $mapel,
                'Rata-rata' => $jumlahsiswa > 0 ? round($total / $jumlahsiswa, 2) : 0,
            ];
        });

        return $hasil->values();
    }

    public function getTrendNilai()
    {
        $guruId = Auth::user()->userable->id;

        $trend = Presensi::selectRaw('presensi.pertemuan_id, AVG(nilai) as rata_nilai')
            ->join('pertemuan', function ($join) {
                $join->on('presensi.pertemuan_id', '=', 'pertemuan.id')
                    ->where('pertemuan.status', 'sedang_berlangsung');
            })
            ->join('pembelajaran', 'pertemuan.pembelajaran_id', '=', 'pembelajaran.id')
            ->where('pembelajaran.guru_id', $guruId)
            ->groupBy('presensi.pertemuan_id')
            ->orderByDesc('pertemuan.created_at')
            ->limit(70)
            ->get();

        $filtered = $trend->filter(function ($item) {
            return !is_null($item->rata_nilai);
        });

        $labels = $filtered->map(function ($item) {
            $pertemuan = Pertemuan::with('pembelajaran.kelas')->find($item->pertemuan_id);

            $kelas = $pertemuan->pembelajaran->kelas->nama_kelas ?? 'Kelas';
            $materi = $pertemuan->materi ?? 'Pertemuan';
            $materi_singkat = implode(' ', array_slice(explode(' ', $materi), 0, 2));

            return [$materi_singkat, $kelas];
        })->values()->all();

        $data = $filtered->pluck('rata_nilai')->values()->all();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    // Tabel
    public function getNilaiDanPertemuanTerbaru($id)
    {
        $nilai_tertinggi = Presensi::with([
            'pertemuan.pembelajaran.mapel',
            'pertemuan.pembelajaran.kelas',
            'siswa'
        ])
            ->whereHas('pertemuan', function ($query) {
                $query->where('status', 'sedang_berlangsung');
            })
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $id)
            ->orderByDesc('nilai')
            ->paginate(5);


        return $nilai_tertinggi;
    }

    public function getPengumuman()
    {
        return Pengumuman::with('admin')->orderBy('created_at', 'desc')->paginate(3);
    }
}
