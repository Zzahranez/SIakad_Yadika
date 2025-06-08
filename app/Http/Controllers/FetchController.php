<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FetchController extends Controller
{
    public function index(){
        return view('fetch');
    }

    public function getData(){
        $data = [];
        for ($i=0; $i < 100; $i++) { 
            $data[] = [
                'id' => $i,
                'nama' => "produk ke-$i",
                'harga' => rand(1000,10000),
            ];
        }
        sleep(5);

        return response()->json($data);
    }
}
