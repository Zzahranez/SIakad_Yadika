<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;

class DetailsPresensiController extends Controller
{
    public function index(string $id)
    {
        $pertemuan = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel'])
            ->findOrFail($id);

        // Bisa juga ambil siswa dari kelas yang terkait
        $siswa = $pertemuan->pembelajaran->kelas->siswa; // Pastikan relasi ini ada

        return view('guru.monitoringpembelajaran.details_presensi', [
            'pertemuan' => $pertemuan,
            'siswa' => $siswa,
        ]);
    }

    public function presensiSiswa(Request $request)
    {

        $request->validate([
            'status' => 'required|array',
        ]);
        // Ambil data status presensi: [id_siswa => status]
        $dataPresensi = $request->input('status');
        $pertemuanId = $request->pertemuan;


        foreach ($dataPresensi as $idSiswa => $status) {
            Presensi::create([
                'pertemuan_id' => $pertemuanId,
                'siswa_id' => $idSiswa,
                'status' => $status,
            ]);
        }
 
        return redirect()->route('nilaisiswa.index')->with('success', 'Siswa berhasil diabsensi');
    }
}
