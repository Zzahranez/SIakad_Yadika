<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pengumuman;
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
        $jumlahGuru = $this->getJumlahGuru();
        $gender_siswa = $this->getJumlahSiswaBerdasarkanGender();
        $siswaTerbaru = $this->getSiswaTerbaru();
        $pengumuman = $this->getPengumuman();

        return view("admindash", [
            'admin' => $admin,
            'semester' => $semesterandyear['semester'],
            'tahun_akademik' => $semesterandyear['tahun_akademik'],
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahguru' => $jumlahGuru,
            'siswaterbaru' => $siswaTerbaru,
            'pengumuman' => $pengumuman,

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

   


    public function getJumlahGuru()
    {
        return Guru::count();
    }
    public function getJumlahSiswaBerdasarkanGender()
    {
        $siswa = Siswa::where('status', 'aktif')->get();
        $siswa = $siswa->groupBy('jenis_kelamin');

        $hasil = $siswa->map(function ($item, $gender) {
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

    public function getSiswaTerbaru()
    {
        return Siswa::where('status', 'aktif')->orderBy('created_at', 'desc')->paginate(5);
    }
    public function getPengumuman(){
        return Pengumuman::with('admin')->orderBy('created_at', 'desc')->paginate(3);
    }


    public function storePengumuman(Request $request){
         
        $admin_id = Auth::user()->userable->id;

        Pengumuman::create([
            'admin_id' => $admin_id,
            'title' => $request->title,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function destroyPengumuman(string $id){
        $pengumuman = Pengumuman::findOrfail($id);

        $pengumuman->delete();

        return redirect()->back()->with('success', "Pengumuman berhasil dihapus");
    }

    public function updatePengumuman(Request $request, string $id){
        $admin_id = Auth::user()->userable->id;

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update([
            'admin_id'  => $admin_id,
            'title' => $request->title,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', "Pengumuman berhasil diedit");
    }
}
