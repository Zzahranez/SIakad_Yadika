<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananControllerAPI extends Controller
{
    public function index()
    {
        $makanan = Makanan::all();
        return response()->json($makanan);
    }

    public function tambahMakanan(Request $request)
    {
        $makanan = Makanan::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return response()->json($makanan);
    }

    public function updateMakanan(Request $request, string $id)
    {
        $makanan = Makanan::findOrFail($id);

        $makanan->update([
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return response()->json($makanan);
    }

    public function destroyMakanan(string $id){
        $makanan = Makanan::findOrFail($id);
        $makanan->delete();

        return response()->json($makanan);
    }

    public function showMakanan(string $id){
        $makanan = Makanan::findOrFail($id);
        return response()->json($makanan);
    }
}
