<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterPembelajaran(Request $request)
    {
        $query = Pembelajaran::with(['kelas', 'guru', 'mapel']);

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->guru_id) {
            $query->where('guru_id', $request->guru_id);
        }

        if ($request->mapel_id) {
            $query->where('mapel_id', $request->mapel_id);
        }

        $pembelajaran = $query->paginate(8);
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapels = Mapel::all();
        $pertemuan = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel', 'pembelajaran.mapel'])->latest()->paginate(8);

        return view('admin.managepembelajaran', compact('pembelajaran', 'kelas', 'guru', 'mapels', 'pertemuan'));
    }

    public function filterPertemuan(Request $request)
    {
        $query = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel', 'pembelajaran.guru']);
        if ($request->guru_id) {
            $query->whereRelation('pembelajaran', 'guru_id', $request->guru_id);
        }

        if ($request->kelas_id) {
            $query->whereRelation('pembelajaran', 'kelas_id', $request->kelas_id);
        }

        if ($request->mapel_id) {
            $query->whereRelation('pembelajaran', 'mapel_id', $request->mapel_id);
        }

        if ($request->tanggal) {
            $query->where('tanggal', $request->tanggal);
        }

        $pertemuan = $query->paginate(8);
        $guru = Guru::all();
        $mapels = Mapel::all();
        $kelas = Kelas::all();
        $pembelajaran = Pembelajaran::with(['kelas', 'guru', 'pertemuan', 'mapel'])->latest()->paginate(8);
        return view('admin.managepembelajaran', [
            'pertemuan' => $pertemuan,
            'pembelajaran' => $pembelajaran,
            'guru' => $guru,
            'kelas' => $kelas,
            'mapels' => $mapels,
        ]);
    }

    public function filterNilai(Request $request)
    {
        $query = Presensi::with(['pertemuan.pembelajaran.kelas', 'pertemuan.pembelajaran.mapel', 'siswa']);

        if ($request->siswa_id) {
            $query->whereRelation('siswa', 'nama', $request->siswa_id);
        }
        if ($request->guru_id) {
            $query->whereRelation('pertemuan.pembelajaran', 'guru_id', $request->guru_id);
        }
        if ($request->kelas_id) {
            $query->whereRelation('pertemuan.pembelajaran', 'kelas_id', $request->kelas_id);
        }
        if ($request->tanggal) {
            $query->whereRelation('pertemuan', 'tanggal', $request->tanggal);
        }

        $nilai = $query->paginate(15);
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('admin.managenilai', [
            'data' => $nilai,
            'guru' => $guru,
            'kelas' => $kelas,
        ]);
    }

    public function resetFilterNilai(){
        return redirect()->route('managenilai.index');
    }
}
