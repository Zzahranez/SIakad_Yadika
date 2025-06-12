<?php

use App\Http\Controllers\AdminDashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\Guru\DetailsPresensiController;
use App\Http\Controllers\Guru\InformasiAkademikController;
use App\Http\Controllers\Guru\JadwalDanPresensiController;
use App\Http\Controllers\Guru\MonitoringPembelajaran;
use App\Http\Controllers\Guru\NilaiSiswaController;
use App\Http\Controllers\Guru\PresensiDanNilaiController;
use App\Http\Controllers\GuruDashController;
use App\Http\Controllers\LuluskanDanMoreKelasController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\ManageKelas;
use App\Http\Controllers\ManageMapelController;
use App\Http\Controllers\ManageNilai;
use App\Http\Controllers\ManagePresensiController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\Profile\ProfileAdminControlller;
use App\Http\Controllers\Profile\ProfileGuruController;
use App\Http\Controllers\Profile\ProfileSiswaController;
use App\Http\Controllers\Siswa\NilaiVisualController;
use App\Http\Controllers\Siswa\PresensiSiswaController;
use App\Http\Controllers\SiswaDashController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('loginform');

//Authentification
Route::post('login', [AuthController::class, 'login'])->name('loginproses');
Route::post('logout', [AuthController::class, 'logout'])->name('logoutproses');


//|=================================|
//|==== Dashboard nanti diganti ====|
//|=================================|


Route::get('DashboardSiswa/index', [DashboardSiswaController::class, 'index'])->name('dashboardsiswa.index');
Route::get('DashboardAdmin/index', [DashboardAdminController::class, 'index'])->name('admindash.index');
Route::get('DashboardGuru/index', [DashboardGuruController::class, 'index'])->name('gurudash.index');


// ProfileAkademik Dan Biodataa
Route::get('profilakademiksiswa/index', [ProfileSiswaController::class, 'index'])->name('profileakademiksiswa.index');
Route::put('profileakademiksiswa/update', [ProfileSiswaController::class, 'update'])->name('profileakademiksiswa.update');
Route::put('profileakademiksiswa/UpdateProfileSiswa', [ProfileSiswaController::class, 'UpdateProfileSiswa'])->name('profilakademiksiswa.UpdateProfileSiswa');
Route::put('profileakademiksiswa/UpdateDetailSiswa', [ProfileSiswaController::class, 'UpdateDetailSiswa'])->name('profileakdemiksiswa.UpdateDetailSiswa');


//|=========================|
//|====== SISWA ROUTE ======|
//|=========================|

//Presensi
Route::get('presensiSiswa', [PresensiSiswaController::class, 'index'])->name('presensisiswa.index');
Route::get('presensiSiswa/details/{id}', [PresensiSiswaController::class, 'detailPresensi'])->name('presensisiswa.details');

//Nilai
Route::get('nilaiSiswa/index', [NilaiVisualController::class, 'index'])->name('nilaiSiswaVisualisasi.index');
Route::get('/detailNilai/show/{id}', [NilaiVisualController::class, 'showDetails'])->name('nilaiSiswaVisualisasi.show');


//|========================|
//|====== GURU ROUTE ======|
//|========================|

//Profile Guru dan biodata
Route::get('profileguru/index', [ProfileGuruController::class, 'index'])->name('profileguru.index');
Route::put('profileguru/update', [ProfileGuruController::class, 'update'])->name('profileguru.update');
Route::put('profileguru/UpdateProfileGuru', [ProfileGuruController::class, 'UpdateProfileGuru'])->name('profileguru.UpdateProfileGuru');
Route::put('profileguru/UpdateDetailGuru', [ProfileGuruController::class, 'UpdateDetailGuru'])->name('profileguru.UpdateDetailguru');

//Monitoring Pembelajaran
Route::get('/monitoringpembelajaran/index', [MonitoringPembelajaran::class, 'index'])->name('monitoringpembelajaran.index');
Route::post('monitoringpembelajaran/store', [MonitoringPembelajaran::class, 'store'])->name('monitoringpembelajaran.store');
Route::get('/monitoringpembelajaran/detailsPresensi/{id}/index', [DetailsPresensiController::class, 'index'])->name('DetailPresensi.index');
Route::post('/monitoringpembelajaran/detailsPresensi/simpan', [DetailsPresensiController::class, 'presensiSiswa'])->name('DetailPresensi.PresensiSiswa');

//Pertemuan dan Details Presensi
Route::get('jadwalmengajar/index', [JadwalDanPresensiController::class, 'index'])->name('JadwalPresensiGuru.index');
Route::delete('/jadwaldanpresensi/index/delete/{id}', [JadwalDanPresensiController::class, 'destroyPertemuan'])->name('jadwaldanpresensi.destroyPertemuan');
Route::get('jadwaldanpresensi/index/show/{id}', [JadwalDanPresensiController::class, 'show'])->name('jadwaldanpresensi.show');
Route::put('/jadwaldanpresensi/index/update/{id}', [JadwalDanPresensiController::class, 'updatePresensi'])->name('jadwaldanpresensi.updatePresensi');

//Nilai Siswa
Route::get('/nilaisiswa/index', [NilaiSiswaController::class, 'index'])->name('nilaisiswa.index');
Route::get('/nilaisiswa/show/{id}', [NilaiSiswaController::class, 'showTambahNiali'])->name('nilaisiswa.showTambahNilai');
Route::post('/nilaisiswa/store/{id}', [NilaiSiswaController::class, 'store'])->name('nilaisiswa.store');

//Presensi Dan Nilai
Route::get('/PresensiandNilai/index', [PresensiDanNilaiController::class, 'index'])->name('presensidannilai.index');
Route::get('PresensiandNilai/show/{id}', [PresensiDanNilaiController::class, 'show'])->name('presensidannilai.show');


//|=======================|
//|===== ADMIN ROUTE =====|
//|=======================|

//Profile Admin
Route::get('profile/profileadmin/index', [ProfileAdminControlller::class, 'index'])->name('profileadmin.index');
Route::put('profileadmin/updatedataAkun', [ProfileAdminControlller::class, 'updatedataAkun'])->name('profileadmin.updatedataAkun');
Route::put('profileadmin/updateProfileAdmin', [ProfileAdminControlller::class, 'updateProfileAdmin'])->name('profileadmin.updateProfileAdmin');

//ManageUser
Route::resource('manageuser', ManageUserController::class);
//ManageKelas
Route::resource('managekelas', ManageKelas::class);
Route::post('managekelas/naikKelas', [LuluskanDanMoreKelasController::class, 'naikKelas'])->name('managekelas.naikKelas');


//Luluskansiswa
Route::get('kelulusansiswa/index', [LuluskanDanMoreKelasController::class, 'index'])->name('kelulusansiswashow');
Route::post('kelulusansiswa/luluskanSiswa', [LuluskanDanMoreKelasController::class, 'luluskanSiswa'])->name('manageuser.luluskanSiswa');
Route::get('kelulusansiswa/getSiswaByKelas', [LuluskanDanMoreKelasController::class, 'getSiswaByKelas'])->name('manageuser.getSiswaByKelas');

//Manage Mapel 
Route::resource('managemapel', ManageMapelController::class);

//Manage Pmebelajaran
Route::resource('managepembelajaran', PembelajaranController::class);

//Manage Pertemuan
Route::resource('managepertemuan', PertemuanController::class);

//FilteringPembelajaran
Route::get('/filter/pembelajaran', [FilterController::class, 'filterPembelajaran'])->name('filter.pembelajaran');
Route::get('/filter/pertemuan', [FilterController::class, 'filterPertemuan'])->name('filter.pertemuan');

//Filtering Nilai
Route::get('ManageNilaiSiswa/filter/nilai', [FilterController::class, 'filterNilai'])->name('filter.nilai');

//Manage Presensi
Route::get('/managepresensi/index', [ManagePresensiController::class, 'index'])->name('managepresensi.index');
Route::put('/managepresensi/update/{id}', [ManagePresensiController::class, 'update'])->name('managepresensi.update');
Route::delete('/managepresensi/destroy/{id}', [ManagePresensiController::class, 'destroy'])->name('managepresensi.destroy');

//Manage Nilai
Route::get('ManageNilaiSiswa/index', [ManageNilai::class, 'index'])->name('managenilai.index');
Route::get('ManageNilaiSiswa/show/{id}', [ManageNilai::class, 'show'])->name('managenilai.show');
Route::put('ManageNilaiSiswa/update/{id}', [ManageNilai::class, 'update'])->name('managenilai.update');

//Pengumuman
Route::post('DashboardSiswa/index/store', [DashboardAdminController::class, 'storePengumuman'])->name('admindash.storePengumuman');
Route::delete('DashboardSiswa/index/delete/{id}', [DashboardAdminController::class, 'destroyPengumuman'])->name('admindash.destroyPengumuman');
Route::put('DashboardSiswa/index/update/{id}', [DashboardAdminController::class, 'updatePengumuman'])->name('admindash.EditPengumuman');

//Testing API
Route::get('/makanan', [MakananController::class, 'index'])->name('makanan.index');
Route::get('/makanan/show/{id}', [MakananController::class, 'show'])->name('makanan.show');
Route::get('/makanan/showtambah/{id}', [MakananController::class, 'showtambah'])->name('makanan.showtambah');
Route::post('/makanan/store', [MakananController::class, 'store'])->name('makanan.store');
 