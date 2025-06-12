<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pembelajaran = Pembelajaran::with(['kelas', 'guru', 'mapel'])->paginate(9);
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapels = Mapel::all();
        $pertemuan = Pertemuan::with(['pembelajaran.guru', 'pembelajaran.mapel', 'pembelajaran.kelas'])->paginate(8);
        
        return view('admin.managepembelajaran', [
            'pembelajaran' => $pembelajaran,
            'kelas' => $kelas,
            'guru' => $guru,
            'mapels' => $mapels,
            'pertemuan' => $pertemuan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pembelajaran::create([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
        ]);
        return redirect()->back()->with('success', 'Pembelajaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        $pembelajaran->update([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        $pembelajaran->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
