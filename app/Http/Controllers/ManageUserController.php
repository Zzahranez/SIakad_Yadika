<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use function Illuminate\Log\log;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $search = $request->input('search');
        $users = User::with('userable')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('email', 'like', "%{$search}%")
                        ->orWhereHas('userable', function ($q2) use ($search) {
                            $q2->where('nama', 'like', "%{$search}%");
                        });
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);



        return view('admin.manageuser', [
            'users' => $users,
            'kelas' => $kelas,
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
        // Validasi data user umum
        $userData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:siswa,guru,admin',
        ]);

        try {
            DB::beginTransaction();

            // Buat user tanpa menyimpan 
            $user = new User();
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role = $userData['role'];

            // Handle data spesifik role
            switch ($userData['role']) {
                case 'siswa':
                    $siswaData = $request->validate([
                        'nama_siswa' => 'required|string|max:255',
                        'nis_nisn' => 'required|string|max:20',
                        'tanggal_lahir' => 'required|date',
                        'kelas' => 'required|exists:kelas,id',
                        'jenis_kelamin_siswa' => 'required|in:laki-laki,perempuan',
                        'alamat_siswa' => 'required|string|max:500',
                        'no_telp_siswa' => 'required|string|max:15',
                        'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
                    ]);

                    $siswa = Siswa::create([
                        'nama' => $siswaData['nama_siswa'],
                        'nis_nisn' => $siswaData['nis_nisn'],
                        'tanggal_lahir' => $siswaData['tanggal_lahir'],
                        'kelas_id' => $siswaData['kelas'],
                        'jenis_kelamin' => $siswaData['jenis_kelamin_siswa'],
                        'alamat' => $siswaData['alamat_siswa'],
                        'no_telp' => $siswaData['no_telp_siswa'],
                        'tahun_masuk' => $siswaData['tahun_masuk'],
                    ]);

                    $user->userable()->associate($siswa);
                    break;

                case 'guru':
                    $guruData = $request->validate([
                        'nama_guru' => 'required|string|max:255',
                        'nip' => 'required|string|max:18',
                        'alamat_guru' => 'required|string|max:500',
                        'jenis_kelamin_guru' => 'required|in:laki-laki,perempuan',
                        'no_telp_guru' => 'required|string|max:15',
                        'status_kepegawaian' => 'required|in:tetap,kontrak,honorer',
                        'tanggal_lahir_guru' => 'required|date',
                        'pendidikan_terakhir_guru' => 'string|in:S1,S2,S3',
                        'jurusan_guru' => 'string|nullable',
                        'tahun_masuk_guru' => 'required|integer|min:2000|max:' . date('Y'),
                    ]);

                    $guru = Guru::create([
                        'nama' => $guruData['nama_guru'],
                        'nip' => $guruData['nip'],
                        'alamat' => $guruData['alamat_guru'],
                        'jenis_kelamin' => $guruData['jenis_kelamin_guru'],
                        'no_telp' => $guruData['no_telp_guru'],
                        'status_kepegawaian' => $guruData['status_kepegawaian'],
                        'tanggal_lahir' => $guruData['tanggal_lahir_guru'],
                        'pendidikan_terakhir' => $guruData['pendidikan_terakhir_guru'],
                        'jurusan' => $guruData['jurusan_guru'],
                        'tahun_masuk' => $guruData['tahun_masuk_guru'],
                    ]);

                    $user->userable()->associate($guru);
                    break;

                case 'admin':
                    $adminData = $request->validate([
                        'nama_admin' => 'required|string|max:255',
                        'alamat_admin' => 'required|string|max:500',
                        'jenis_kelamin_admin' => 'required|in:laki-laki,perempuan',
                        'status_admin' => 'required|in:aktif,tidak-aktif',
                        'no_telp_admin' => 'string|max:15',
                        'tanggal_lahir_admin' => 'required|date'

                    ]);

                    $admin = Admin::create([
                        'nama' => $adminData['nama_admin'],
                        'alamat' => $adminData['alamat_admin'],
                        'jenis_kelamin' => $adminData['jenis_kelamin_admin'],
                        'status' => $adminData['status_admin'],
                        'tanggal_lahir' => $adminData['tanggal_lahir_admin'],
                        'no_telp' => $adminData['no_telp_admin'],
                    ]);

                    $user->userable()->associate($admin);
                    break;
            }

            // Simpan user setelah relasi diatur
            $user->save();
            DB::commit();

            return redirect()->route('manageuser.index')
                ->with('success', 'User ' . ucfirst($user->role) . ' berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding user: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('userable')->findOrFail($id);
        return view('admin.userdetail', ['user' => $user]);
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
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|in:siswa,guru,admin',
        ]);

        $user->email = $request->email;
        if ($request->filled('password') && $request->filled('confirmed_password') && $request->password === $request->confirmed_password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();

        if ($user->userable_type === Siswa::class) {
            $request->validate([
                'nama' => 'required|string',
                'nis_nisn' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'kelas' => 'required|exists:kelas,id',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'alamat' => 'string',
                'no_telp' => 'string',
                'status_siswa' => 'required|in:aktif,lulus,pindah,dikeluarkan',
                'tahun_masuk' => 'required|digits:4|integer|min:1900|max:' . date('Y')

            ]);

            $user->userable->update([
                'nama' => $request->nama,
                'nis_nisn' => $request->nis_nisn,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelas_id' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'status' => $request->status_siswa,
                'tahun_masuk' => $request->tahun_masuk,
            ]);
        } elseif ($user->userable_type === Guru::class) {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:20',
                'alamat_guru' => 'required|string|max:500',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'no_telp' => 'string',
                'tanggal_lahir_guru' => 'required|date',
                'status_kepegawaian' => 'required|in:tetap,kontrak,honorer',
                'pendidikan_terakhir' => 'required|in:S1,S2,S3',
                'jurusan' => 'nullable|string|max:50',
                'tahun_masuk' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            ]);

            $user->userable->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat_guru,
                'jenis' => $request->jenis_kelamin,

                'no_telp' => $request->no_telp,
                'tanggal_lahir' => $request->tanggal_lahir_guru,
                'status_kepegawaian' => $request->status_kepegawaian,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'jurusan' => $request->jurusan,
                'tahun_masuk' => $request->tahun_masuk,
            ]);
        } elseif ($user->userable_type === Admin::class) {
            $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:50',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
