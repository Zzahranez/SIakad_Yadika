<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LuluskanDanMoreKelasController extends Controller
{
    public function index(Request $request)
    {
        //Kelas 
        $kelas_all = Kelas::all()->sort(function ($a, $b) {
            // Ambil semua angka ambil semua huruf dan pisahkan spasi
            preg_match('/(\d+)([A-Za-z]+)/', str_replace(' ', '', $a->nama_kelas), $matchesA);
            preg_match('/(\d+)([A-Za-z]+)/', str_replace(' ', '', $b->nama_kelas), $matchesB);

            $a_num = (int) $matchesA[1];
            $a_abjad = $matchesA[2];

            $b_num = (int) $matchesB[1];
            $b_abjad = $matchesB[2];

            return $a_num === $b_num
                ? strcmp($a_abjad, $b_abjad)
                : $a_num <=> $b_num;
        });
        $id_kelas_untuk_lulus = $request->kelas_id_for_lulus;
        $siswa = collect();
        $nama_kelas = '';

        // Jika ada kelas yang dipilih
        if ($id_kelas_untuk_lulus) {
            $kelas_new = Kelas::find($id_kelas_untuk_lulus);

            if ($kelas_new) {
                $nama_kelas = $kelas_new->nama_kelas;
                $siswa = Siswa::where('kelas_id', $id_kelas_untuk_lulus)
                    ->whereNotIn('status', ['lulus', 'dikeluarkan', 'pindah'])
                    ->orderBy('nama')
                    ->get();
            }
        }

        return view('admin.kelulusansiswa', [
            'kelas_all' => $kelas_all,
            'siswa' => $siswa,
            'kelas_nama' => $nama_kelas,
        ]);
    }


    public function naikKelas(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'kelas_baru_id' => 'required|exists:kelas,id',
        ]);

        Siswa::whereIn('id', $request->siswa_ids)
            ->update(['kelas_id' => $request->kelas_baru_id]);

        return redirect()->route('managekelas.index', ['kelas_id' => $request->kelas_baru_id])
            ->with('success', 'Siswa berhasil dinaikkan ke kelas baru.');
    }

    public function luluskanSiswa(Request $request)
    {
        // Validasi
        $request->validate([
            'cekboxsiswa' => 'required|array',
            'cekboxsiswa.*' => 'exists:siswa,id'
        ]);

        try {
            Siswa::whereIn('id', $request->cekboxsiswa)
                ->update(['status' => 'lulus']);

            return back()->with('success', 'Siswa yang dipilih berhasil diluluskan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal meluluskan siswa: ' . $e->getMessage());
        }
    }


    public function getSiswaByKelas(Request $request)
    {
        $siswa = Siswa::where('kelas_id', $request->kelas_id)
            ->whereNotIn('status', ['lulus', 'dikeluarkan', 'pindah'])->get();

        return response()->json(['siswa' => $siswa]);
    }
}
