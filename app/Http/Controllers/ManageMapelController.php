<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapels = Mapel::paginate(7);
        return view('admin.matapelajaran', [
            'mapels' => $mapels,
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
        $request->validate([
            'nama_mapel' => 'required|string|max:80'
        ]);
        Log::info('STORE DIPANGGIL', $request->all());
        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
        ]);
        return redirect()->back()->with('success', 'Mata pelajaran berhasil ditambahkan');
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
        $request->validate([
            'nama_mapel_edit' => 'required|string|max:70',
        ]);

        $mapels = Mapel::findOrFail($id);
        $mapels->update([
            'nama_mapel' => $request->nama_mapel_edit,
        ]);

        return redirect()->back()->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapels = Mapel::findOrFail($id);
        $mapels->delete();

        return redirect()->back()->with('success', 'Mata Pelajaran Berhasil dihapus Berhasil dihapus');
    }
}
