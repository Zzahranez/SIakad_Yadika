<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LuluskanDanMoreKelasController extends Controller
{
    public function index(Request $request)
    {
        $kelas_all = Kelas::all()
            ->filter(function ($kelas) {
                // Hapus spasi lalu cocokkan jika diawali angka 12
                return preg_match('/^12/', str_replace(' ', '', $kelas->nama_kelas));
            })
            ->sort(function ($a, $b) {
                // Ambil angka dan huruf, lalu urutkan berdasarkan angka lalu abjad
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

        return view('admin.kelulusansiswa', compact('kelas_all', 'siswa', 'nama_kelas'));
    }



    public function naikKelas(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'kelas_baru_id' => 'required|exists:kelas,id',
        ]);

        // Ambil kelas lama dari salah satu siswa SEBELUM update
        $kelasLamaId = Siswa::find($request->siswa_ids[0])->kelas_id;

        // Update semua siswa ke kelas baru
        Siswa::whereIn('id', $request->siswa_ids)
            ->update(['kelas_id' => $request->kelas_baru_id]);

        Pertemuan::where('status', 'sedang_berlangsung')
            ->whereHas('pembelajaran', function ($query) use ($kelasLamaId) {
                $query->where('kelas_id', $kelasLamaId);
            })
            ->update(['status' => 'selesai']);


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
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        // Ambil kelas yang dipilih
        $kelas_saat_ini = Kelas::find($request->kelas_id);
        if (!$kelas_saat_ini) {
            Log::error('Kelas tidak ditemukan', ['kelas_id' => $request->kelas_id]);
            return response()->json(['error' => 'Kelas tidak ditemukan'], 404);
        }

        // Ekstrak tahun dari nama_kelas dengan pola yang lebih fleksibel
        $nama_kelas = str_replace(' ', '', $kelas_saat_ini->nama_kelas); // Hapus spasi
        $tahun_saat_ini = 0;
        if (preg_match('/^(?:Kelas\s*)?(\d+|[XVI]+)/i', $nama_kelas, $matches)) {
            $tahun = $matches[1];
            // Konversi romawi ke angka jika perlu
            if (in_array(strtoupper($tahun), ['X', 'XI', 'XII'])) {
                $tahun_saat_ini = ['X' => 10, 'XI' => 11, 'XII' => 12][strtoupper($tahun)];
            } else {
                $tahun_saat_ini = (int)$tahun;
            }
        }
        Log::info('Tahun saat ini', ['kelas_id' => $request->kelas_id, 'nama_kelas' => $nama_kelas, 'tahun' => $tahun_saat_ini]);

        // Ambil siswa
        $siswa = Siswa::where('kelas_id', $request->kelas_id)
            ->whereNotIn('status', ['lulus', 'dikeluarkan', 'pindah'])
            ->orderBy('nama')
            ->get();

        // Ambil kelas dengan tahun lebih tinggi
        $kelas = Kelas::where('id', '!=', $request->kelas_id)
            ->get()
            ->filter(function ($kelas) use ($tahun_saat_ini) {
                $nama_kelas = str_replace(' ', '', $kelas->nama_kelas);
                if (preg_match('/^(?:Kelas\s*)?(\d+|[XVI]+)/i', $nama_kelas, $matches)) {
                    $tahun_kelas = $matches[1];
                    if (in_array(strtoupper($tahun_kelas), ['X', 'XI', 'XII'])) {
                        $tahun_kelas = ['X' => 10, 'XI' => 11, 'XII' => 12][strtoupper($tahun_kelas)];
                    } else {
                        $tahun_kelas = (int)$tahun_kelas;
                    }
                    return $tahun_kelas > $tahun_saat_ini;
                }
                return false;
            })
            ->values();

        Log::info('Kelas tujuan ditemukan', ['count' => $kelas->count(), 'kelas' => $kelas->pluck('nama_kelas')->toArray()]);

        return response()->json([
            'siswa' => $siswa,
            'kelas' => $kelas,
        ]);
    }
}
