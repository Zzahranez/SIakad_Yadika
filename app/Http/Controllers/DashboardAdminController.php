<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        /** @var App/Models/User $admin */
        $admin = Auth::user();
        $semesterandyear = $this->getSemesterandTahunAkademik();
        $jumlahSiswa = $this->getJumlahSiswa();
        $presentaseKehadiran = $this->getPresentaseKehadiranSiswa();
        $jumlahGuru = $this->getJumlahGuru();
        $gender_siswa = $this->getJumlahSiswaBerdasarkanGender();
        $siswaTerbaru = $this->getSiswaTerbaru();

        return view("admindash", [
            'admin' => $admin,
            'semester' => $semesterandyear['semester'],
            'tahun_akademik' => $semesterandyear['tahun_akademik'],
            'jumlahSiswa' => $jumlahSiswa,
            'presentaseKehadiran' => $presentaseKehadiran,
            'jumlahguru' => $jumlahGuru,
            'siswaterbaru' => $siswaTerbaru,
            
            //Grafik
            'label_piecart_gender' => $gender_siswa['label'],
            'data_piecart_gender' => $gender_siswa['data'],
        ]);
    }

    public function getSemesterandTahunAkademik()
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
            'tahun_akademik' => $tahun_akademik
        ];
    }
 
    public function getJumlahSiswa()
    {
        return Siswa::where('status', 'aktif')->count();
    }

    public  function getPresentaseKehadiranSiswa()
    {
        $totalKehadiran = Presensi::with(['pertemuan.pembelajaran', 'siswa'])
            ->where('status', 'hadir')
            ->whereRelation('siswa', 'status',  'aktif')
            ->count();

        $totalTidakHadir = Presensi::with('pertemuan')
                            ->where('status','!=', 'hadir' )
                            ->count();
        $total = $totalKehadiran + $totalTidakHadir;

        $presentase = round(($totalKehadiran / $total) * 100 , 2); 

        return $presentase;
    }

    public function getJumlahGuru(){
        return Guru::count();
    }
    public function getJumlahSiswaBerdasarkanGender(){
        $siswa = Siswa::where('status', 'aktif')->get();
        $siswa = $siswa->groupBy('jenis_kelamin');
        
        $hasil = $siswa->map(function($item, $gender){
            return [
                'label' => $gender,
                'data' => $item->count()
            ];
        })->values();

        return [
            'label' => $hasil->pluck('label')->toArray(),
            'data' => $hasil->pluck('data')->toArray()
        ];
    }

    public function getSiswaTerbaru(){
        return Siswa::where('status', 'aktif')->orderBy('created_at', 'desc')->paginate(5);
    }
}
