<?php

namespace App\Http\Controllers;

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
        $jmlh_pertemuan = $this->getPertemuanBerlangsung();
        $presentase_kehadiran = $this->getPresentaseKehadiranKelas();
        $presentase_Nilai = $this->getRataNilaiSiswaPertemuan($guru_id);

        //Grafik
        $nilaipermapel = $this->getNilaiRataSiswaPerMapel($guru_id);
        $trendData = $this->getTrendNilai();

        // $labels_line = $trendData['labels'];
        // $data_line = $trendData['data'];

        // dd($labels_line, $data_line);

        //Table
        $nilai = $this->getNilaiDanPertemuanTerbaru($guru_id);

        return view("gurudash", [
            'nama_user' => $nama_user,
            'semester' => $tahunandSemester['semester'],
            'tahun_akademik' => $tahunandSemester['tahun_akademik'],
            'jmlh_pertemuan' => $jmlh_pertemuan,
            'presentase_kehadiran' => $presentase_kehadiran,
            'presentase_nilaiSiswa' => $presentase_Nilai,
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

    public function getPertemuanBerlangsung()
    {
        $guru_id = Auth::user()->userable->id;
        return Pertemuan::with('pembelajaran')
            ->whereRelation('pembelajaran', 'guru_id', $guru_id)
            ->count();
    }

    public function getPresentaseKehadiranKelas()
    {
        $guru_id = Auth::user()->userable->id;

        $totalPresensi = Presensi::with(['pertemuan.pembelajaran'])
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $guru_id)
            ->count();

        $jumlahHadir = Presensi::with('pertemuan.pembelajaran')
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $guru_id)
            ->where('status', 'hadir')
            ->count();

        $presentase = $totalPresensi > 0 ? round(($jumlahHadir / $totalPresensi) * 100, 2) : 0;

        return $presentase;
    }

    public function getRataNilaiSiswaPertemuan($id)
    {

        $rataRataNilai = Presensi::whereNotNull('nilai')
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $id)
            ->avg('nilai');

        return round($rataRataNilai, 2); // dib
    }
    //Grafik
    public function getNilaiRataSiswaPerMapel($id)
    {

        $presensi =  Presensi::with(['pertemuan.pembelajaran.mapel'])
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $id)
            ->get();

        $perMapel = $presensi->groupBy(function ($item) {
            return $item->pertemuan->pembelajaran->mapel->nama_mapel;
        });
        $hasil = $perMapel->map(function ($item, $mapel) {
            $total = $item->sum('nilai');
            $jumlahsiswa = $item->count();

            return [
                'mapel' => $mapel,
                'Rata-rata' => round($total / $jumlahsiswa, 2),
            ];
        });
        return $hasil->values();
    }

    public function getTrendNilai()
    {
        $guruId = Auth::user()->userable->id;

        $trend = Presensi::selectRaw('presensi.pertemuan_id, AVG(nilai) as rata_nilai')
            ->join('pertemuan', 'presensi.pertemuan_id', '=', 'pertemuan.id')
            ->join('pembelajaran', 'pertemuan.pembelajaran_id', '=', 'pembelajaran.id')
            ->where('pembelajaran.guru_id', $guruId)
            ->groupBy('presensi.pertemuan_id')
            ->orderByDesc('pertemuan.created_at')
            ->limit(70)
            ->get();



        // Filter agar hanya data yang tidak null
        $filtered = $trend->filter(function ($item) {
            return !is_null($item->rata_nilai);
        });

        $labels = $filtered->map(function ($item) {
            $kelas = $item->pertemuan->pembelajaran->kelas->nama_kelas ?? 'Kelas';
            $materi = $item->pertemuan->materi ?? 'Pertemuan';

            // Ambil dua kata pertama dari materi (kalau terlalu panjang)
            $materi_singkat = implode(' ', array_slice(explode(' ', $materi), 0, 2));

            return [$materi_singkat, $kelas]; // Array = multiline label
        })->values()->all();


        $data = $filtered->pluck('rata_nilai')->values()->all();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }


    //Table
    public function getNilaiDanPertemuanTerbaru($id)
    {

        $nilai_tertinggi = Presensi::with(['pertemuan.pembelajaran.mapel', 'pertemuan.pembelajaran.kelas', 'siswa'])
            ->whereRelation('pertemuan.pembelajaran', 'guru_id', $id)
            ->orderBy('nilai', 'desc')->paginate(5);

        return $nilai_tertinggi;
    }

    public function getPengumuman(){
        return Pengumuman::with('admin')->orderBy('created_at', 'desc')->paginate(3);
    }
}
