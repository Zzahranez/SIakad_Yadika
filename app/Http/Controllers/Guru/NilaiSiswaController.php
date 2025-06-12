<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiSiswaController extends Controller
{
    public function index()
    {

        $pertemuan = Pertemuan::with(['presensi', 'pembelajaran.kelas', 'pembelajaran.mapel'])
                    ->orderBy('created_at', 'desc')
                    ->where('created_at', '>=', now()->subMinute(3))
                    ->paginate(7);
        return view('guru.nilaisiswa', [
            'pertemuan' => $pertemuan,
        ]);
    }

    public function showTambahNiali(string $pertemuanId)
    {
        $pertemuan = Pertemuan::with(['presensi.siswa', 'pembelajaran.kelas', 'pembelajaran.mapel'])
            ->findOrFail($pertemuanId);

        return view('guru.nilai_siswa.tambah_nilai', [
            'pertemuan' => $pertemuan,
        ]);
    }

    public function store(Request $request, $pertemuanId)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
        ]);

        foreach ($request->nilai as $presensi_id => $nilai) {
            \App\Models\Presensi::where('id', $presensi_id)->update([
                'nilai' => $nilai,
            ]);
        }

        return redirect()->route('nilaisiswa.index', $pertemuanId)->with('success', 'Nilai berhasil disimpan.');
    }
}
