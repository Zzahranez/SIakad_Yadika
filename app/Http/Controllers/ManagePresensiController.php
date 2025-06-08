<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;

class ManagePresensiController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapels = Mapel::all();

        $query = Presensi::with([
            'pertemuan.pembelajaran.kelas',
            'pertemuan.pembelajaran.guru',
            'pertemuan.pembelajaran.mapel',
            'siswa'
        ]);

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('pertemuan.pembelajaran.kelas', function ($q) use ($request) {
                $q->where('id', $request->kelas);
            });
        }

        // Filter berdasarkan guru
        if ($request->filled('guru')) {
            $query->whereHas('pertemuan.pembelajaran.guru', function ($q) use ($request) {
                $q->where('id', $request->guru);
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereHas('pertemuan', function ($q) use ($request) {
                $q->whereDate('tanggal', $request->tanggal);
            });
        }


        /** @var \Illuminate\Pagination\LengthAwarePaginator  */

        $presensi = $query->paginate(10)->withQueryString();


        return view('admin.managepresensi', [
            'kelas' => $kelas,
            'guru' => $guru,
            'mapels' => $mapels,
            'presensi' => $presensi,
            'filter' => $request->only(['kelas', 'guru', 'tanggal']),
        ]);
    }


    public function update(Request $request, string $id)
    {

        $presen = Presensi::findOrFail($id);
        $presen->update([
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $presen = Presensi::findOrfail($id);
        $presen->delete();

        return redirect()->back()->with('success', 'Presensi berhasil dihapus');
    }
}
