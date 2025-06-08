<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $kelas = Kelas::all();
        $user = $user->load('userable');
        return view('siswa.profilakademiksiswa', [
            'user' => $user,
            'kelas' => $kelas,
        ]);
    }


    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'string|max:50|required|email',
            'password' => 'string|min:8|nullable|confirmed',

        ]);

        $user->userable->nama = $request->nama;
        $user->email = $request->email;
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        $user->userable->save();



        return back()->with('succes', 'Data berhasil diupdate');
    }

    /** 
     * Update Detail Users
     */
    public function UpdateDetailSiswa(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $data_guru = $user->userable; // Mendapatkan model Guru yang terkait dengan user

        // Validasi hanya untuk dua field: nip dan jenis_kelamin
        $request->validate([

            'jenis_kelamin' => 'required|in:laki-laki,perempuan', // Validasi jenis kelamin
            'alamat' => 'required|string|max:500',
            'nis_nisn' => 'required|string|max:30',
            'tanggal_lahir_siswa' => 'required|date',
            'no_telp' => 'required|string|max:15',
            // 'kelas' => 'required|string',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),

        ]);

        // Melakukan update pada data guru
        $data_guru->update([
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'nis_nisn' => $request->nis_nisn,
            'tanggal_lahir' => $request->tanggal_lahir_siswa,
            'no_telp' => $request->no_telp,
            // 'kelas' => $request->kelas,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        // Menampilkan pesan sukses dan kembali ke halaman sebelumnya
        return back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Update prpfile pengguna
     */
    public function UpdateProfileSiswa(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'profil_siswa' => 'nullable|image|mimes:png,jpg,jpeg|max:255'
        ]);

        $siswa = $user->userable;
        if ($request->hasFile('profil_siswa')) {
            // Hapus foto lama jika ada
            if ($siswa->foto_profile) {
                Storage::disk('public')->delete('profile_siswa/' . $siswa->foto_profile);
            }

            $file = $request->file('profil_siswa');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_siswa', $fileName, 'public');
            $siswa->foto_profile = $fileName;
            $siswa->save();
        }
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
