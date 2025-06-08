<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageKelas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $kelas = Kelas::paginate(4);
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
        $siswa = collect();

        if ($request->has('kelas_id') && $request->kelas_id) {
            $siswa = Siswa::where('kelas_id', $request->kelas_id)
                ->whereNotIn('status', ['lulus', 'dikeluarkan', 'pindah'])->get();
        }

        if ($request->ajax() && $request->has('action') && $request->action === 'siswa') {
            $kelas_filtered = $kelas_all->where('id', '!=', $request->kelas_id)->values();
            return response()->json([
                'success' => true,
                'siswa' => $siswa,
                'kelas' => $kelas_filtered
            ], 200);
        }

        return view('admin.managekelas', compact('kelas', 'kelas_all', 'siswa'));
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

        $request->validate([
            'nama_kelas' => 'required|string',
        ]);
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);
        return redirect()->back()->with('success', 'Kelas Berhasil Ditambahakan');
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
        //
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'nama_kelas_edit' => 'required|string|max:255',
        ]);
        $kelas->nama_kelas = $request->nama_kelas_edit;
        $kelas->save();
        return redirect()->back()->with('success', 'Kelas Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();
        return redirect()->back()->with('success', 'Kelas Berhasil dihapus');
    }
}
