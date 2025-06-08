<?php


use App\Http\Controllers\API\MakananControllerAPI;
use App\Http\Controllers\MakananController;
use Illuminate\Support\Facades\Route;

Route::get('/get/makanan', [MakananControllerAPI::class,  'index']);
Route::post('/store/makanan', [MakananControllerAPI::class,  'tambahMakanan']);
Route::put('/update/makanan/{id}', [MakananControllerAPI::class, 'updateMakanan']);
Route::delete('/delete/makanan/{id}', [MakananControllerAPI::class, 'destroyMakanan']);
Route::get('show/makanan/{id}', [MakananControllerAPI::class, 'showMakanan']);
