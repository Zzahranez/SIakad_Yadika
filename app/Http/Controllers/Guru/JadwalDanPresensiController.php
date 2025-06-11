<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalDanPresensiController extends Controller
{

    public function index()
    {
        $guru_login = Auth::user()->userable;


        // Ambil semua ID pembelajaran milik guru
        $pembelajaranIds = Pembelajaran::where('guru_id', $guru_login->id)->pluck('id');

        // Ambil data pembelajaran untuk ditampilkan (terpisah dan paginated)
        $pembelajaran = Pembelajaran::with(['kelas', 'mapel'])
            ->withCount('pertemuan')
            ->where('guru_id', $guru_login->id)
            ->paginate(6);

        // Ambil semua pertemuan berdasarkan semua pembelajaran guru
        $pertemuan = Pertemuan::with(['pembelajaran.kelas', 'pembelajaran.mapel'])
            ->whereIn('pembelajaran_id', $pembelajaranIds)
            ->latest()
            ->paginate(7); 



        return view('guru.jadwaldanpresensi', [
            'pembelajaran' => $pembelajaran,
            'pertemuan' => $pertemuan,
        ]);
    }

    public function show(string $id)
    {
        $pertemuan = Pertemuan::with(['pembelajaran.kelas.siswa', 'pembelajaran.mapel'])->findOrFail($id);
        $presensi = Presensi::where('pertemuan_id', $id)->get()->keyBy('siswa_id');
        return view('guru.jadwaldanpresensi.jadwaldetails', [
            'pertemuan' => $pertemuan,
            'presensi' => $presensi
        ]);
    }

    public function updatePresensi(Request $request, string $id)
    {
        $dataSiswa = $request->input('presensi', []); // pastikan ambil input presensi, default []

        $updatedNames = [];

        foreach ($dataSiswa as $siswa_id => $status) {
            // Cari data presensi existing
            $presensi = Presensi::where('pertemuan_id', $id)
                ->where('siswa_id', $siswa_id)
                ->first();

            if ($presensi) {
                // Update jika ada
                $presensi->update(['status' => $status]);
            } else {
                // Jika belum ada, buat baru
                Presensi::create([
                    'pertemuan_id' => $id,
                    'siswa_id' => $siswa_id,
                    'status' => $status,
                ]);
            }

            // Ambil nama siswa dari relasi, atau fallback
            $namaSiswa = $presensi->siswa->nama ?? "Id: $siswa_id";
            $updatedNames[] = $namaSiswa;
        }

        $namesString = implode(', ', $updatedNames);

        return redirect()->route('presensidannilai.index')->with('success', "Absen berhasil diupdate pada siswa berikut: $namesString");
    }


    public function destroyPertemuan(string $id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        $pertemuan->delete();
        return redirect()->back()->with('success', 'Pertemuan berhasil dihapus');
    }
}
