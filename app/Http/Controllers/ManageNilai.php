<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Presensi;
use Illuminate\Http\Request;

class ManageNilai extends Controller
{

    public function index()
    {
        $presensi = Presensi::with(['siswa', 'pertemuan.pembelajaran.kelas', 'pertemuan.pembelajaran.mapel', 'pertemuan.pembelajaran.guru'])
            ->whereNotNull('nilai')->paginate(15);
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('admin.managenilai', [
            'data' => $presensi,
            'guru' => $guru,
            'kelas' => $kelas
        ]);
    }

    public function show(string $id)
    {
        $presensi = Presensi::with(['siswa', 'pertemuan.pembelajaran.kelas', 'pertemuan.pembelajaran.mapel', 'pertemuan.pembelajaran.guru'])
            ->where('id', $id)
            ->whereNotNull('nilai')->firstOrFail();
        return view('admin.managenilai.edit_nilai', [
            'data' => $presensi,
        ]);
    }

    public function update(Request $request, string $id){
   
        $presensi = Presensi::findOrFail($id);
        $presensi->update([
            'nilai' => $request->nilai
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil diperbarui');
    }
}
