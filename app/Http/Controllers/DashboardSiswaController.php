<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardSiswaController extends Controller
{
    public function index()
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $siswa_id = Auth::user()->userable->id;
        $year = date('d-m-Y');
        $nama_user = $user->load('userable');

        //Semester dan tahun akademik
        $semesterinfo = $this->getSemesterDanTahunAkademik();
        $gurudanmapel = $this->getMapelDanGuruMengajar();
        $nilaiRataAll = $this->getNilaiRataAll();
        $pertemuanberlangsung = $this->getPertemuanBerlangsung($siswa_id);
        $kehadiran = $this->getKehadiran();

        //Grafik
        $nilaiPerKelas = $this->getNilaiRataperKelas();
        $labels = $nilaiPerKelas->pluck('mapel');
        $data = $nilaiPerKelas->pluck('rata_rata_nilai');

        $jumlahkehadirankelasperpembelajaran = $this->getJumlahKehadiranPerPembelajaranByUser();
        $data_totalpembelajaranKelas = $jumlahkehadirankelasperpembelajaran->pluck('total_kehadiran');
  
        return view(
            'dashboardsiswa',
            [
                'nama_user' => $nama_user,
                'date' => $year,
                'semester' => $semesterinfo['semester'],
                'tahun_akademik' => $semesterinfo['tahun_akademik'],
                'gurudanmapel' => $gurudanmapel,
                'nilairataAll' => $nilaiRataAll,
                'pertemuanberlangsung' => $pertemuanberlangsung,
                'kehadiran' => $kehadiran,
                //Grafik
                'labels' => $labels,
                'data' => $data,
                'total_kehadiran' => $data_totalpembelajaranKelas,
            ]
        );
    }

    //|=============================|
    //|====== DASHBOARD SISWA ======|
    //|=============================|

    public function getSemesterDanTahunAkademik()
    {
        $today = Carbon::now();
        $bulan = $today->month;
        $tahun = $today->year;

        if ($bulan >= 1 && $bulan < 6) {
            $semester = 'Genap';
            $tahun_akademik = ($tahun - 1) . '/' . $tahun;
        } else {
            $semester = 'Ganjil';
            $tahun_akademik = $tahun . '/' . ($tahun + 1);
        }

        return [
            'semester' => $semester,
            'tahun_akademik' => $tahun_akademik,
        ];
    }

    public function getMapelDanGuruMengajar()
    {
        $siswa_id = Auth::user()->userable->id;
        return Pembelajaran::with(['kelas', 'guru', 'mapel', 'pertemuan.presensi'])
            ->whereRelation('pertemuan.presensi', 'siswa_id', $siswa_id)->get();
    }

    public function getNilaiRataAll()
    {
        $siswa_id = Auth::user()->userable->id;
        $nilai_rataAll =  Presensi::where('siswa_id', $siswa_id)->avg('nilai') ?? 0;

        return round($nilai_rataAll, 2);
    }

    public function getPertemuanBerlangsung($siswa_id)
    {
        return Pertemuan::with(['presensi'])
            ->whereRelation('presensi', 'siswa_id', $siswa_id)
            ->count();
    }

    public function getKehadiran()
    {
        $siswa_id = Auth::user()->userable->id;

        // Total pertemuan yang harus dihadiri siswa
        $totalPertemuan = Presensi::where('siswa_id', $siswa_id)->count();

        if ($totalPertemuan == 0) {
            return 0;
        }

        $totalHadir = Presensi::where('siswa_id', $siswa_id)
            ->where('status', 'hadir')
            ->count();

        $persentase = ($totalHadir / $totalPertemuan) * 100;

        return round($persentase, 2);
    }

    //Nilai rata-rata pertemuan dari setiap kelas
    public function getNilaiRataperKelas()
    {
        $siswa_id = Auth::user()->userable->id;
        $kelas_id = Auth::user()->userable->kelas_id;

        $pembelajaranKelas = Pembelajaran::with('mapel')
            ->where('kelas_id', $kelas_id)
            ->get();

        $hasil = $pembelajaranKelas->map(function ($pembelajaran) use ($siswa_id) {

            $presensiSiswa = Presensi::where('siswa_id', $siswa_id)
                ->whereHas('pertemuan.pembelajaran', function ($query) use ($pembelajaran) {
                    $query->where('id', $pembelajaran->id);
                })
                ->with('pertemuan.pembelajaran')
                ->get();


            $rataRata = $presensiSiswa->avg('nilai');

            return [
                'mapel' => $pembelajaran->mapel->nama_mapel,
                'pembelajaran_id' => $pembelajaran->id,
                'rata_rata_nilai' => round($rataRata, 2),
            ];
        });

        return $hasil;
    }


    public function getJumlahKehadiranPerKelas()
    {
        return Presensi::join('pertemuan', 'presensi.pertemuan_id', '=', 'pertemuan.id')
            ->join('pembelajaran', 'pertemuan.pembelajaran_id', '=', 'pembelajaran.id')
            ->join('kelas', 'pembelajaran.kelas_id', '=', 'kelas.id')
            ->select('kelas.nama_kelas as kelas_nama', DB::raw('COUNT(presensi.id) as total_kehadiran'))
            ->where('presensi.status', 'hadir')
            ->groupBy('kelas.id', 'kelas.nama_kelas')
            ->get()
            ->map(function ($item) {
                // pastikan hanya atribut yang dibutuhkan yang dipakai, 
                // atau kamu bisa kembalikan object biasa tanpa model Presensi
                return [
                    'kelas_nama' => $item->kelas_nama,
                    'total_kehadiran' => $item->total_kehadiran,
                ];
            });
    }
    public function getJumlahKehadiranPerPembelajaranByUser()
    {
        $siswaId = Auth::user()->id; // id user login

        return DB::table('presensi')
            ->join('pertemuan', 'presensi.pertemuan_id', '=', 'pertemuan.id')
            ->join('pembelajaran', 'pertemuan.pembelajaran_id', '=', 'pembelajaran.id')
            ->join('kelas', 'pembelajaran.kelas_id', '=', 'kelas.id')
            ->join('mapel', 'pembelajaran.mapel_id', '=', 'mapel.id')
            ->where('presensi.siswa_id', $siswaId) // ambil hanya presensi user login
            ->select(
                'pembelajaran.id as pembelajaran_id',
                'kelas.nama_kelas as nama_kelas',
                'mapel.nama_mapel as nama_mapel',
                DB::raw('COUNT(presensi.id) as total_kehadiran')
            )
            ->groupBy('pembelajaran.id', 'kelas.nama_kelas', 'mapel.nama_mapel')
            ->get();
    }

    
}
