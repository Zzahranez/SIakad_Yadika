<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        $makanan = Makanan::all();
        return view('makanan.makanan', [
            'makanan' => $makanan,
        ]);
    }

    public function show(string $id)
    {
        $makanan = Makanan::findOrFail($id);
        return view('makanan.details', [
            'makanan' => $makanan,
        ]);
    }
    public function showtambah(string $id)
    {
        $makanan = Makanan::findOrfail($id);
        return view('makanan.tambahmakan', ['makanan', $makanan]);
    }
    public function store(Request $request){

        $harga = preg_replace('[^0-9]','',$request->harga);
        Makanan::create([
            'nama' => $request->nama,
            'harga' => (float) $request->harga,
        ]);

        return redirect()->route('makanan.index')->with('success', 'Makanan Berhasil DiTambahkan');
    }
}
