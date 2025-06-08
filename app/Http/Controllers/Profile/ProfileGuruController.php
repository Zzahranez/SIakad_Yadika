<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) {
            Log::error('No authenticated user');
            return redirect()->route('loginform')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = $user->load('userable');
        if (!$guru->userable) {
            Log::error('Userable null', ['user_id' => $user->id]);
            return redirect()->route('gurudash.index')->with('error', 'Data guru tidak ditemukan');
        }

        return view('guru.profileguru', ['guru' => $guru]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $guru */
        $guru = Auth::user();
        if (!$guru->userable) {
            Log::error('Userable null', ['user_id' => $guru->id]);
            return back()->with('error', 'Data guru tidak ditemukan');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($guru->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        try {
            $guru->userable->nama = $request->nama;
            $guru->email = $request->email;
            if ($request->filled('password') && $request->filled('password_confirmation')) {
                $guru->password = bcrypt($request->password);
            }

            DB::transaction(function () use ($guru) {
                $guru->save();
                $guru->userable->save();
            });

            return back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Update failed:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function UpdateProfileGuru(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'profil_guru' => 'nullable|image|mimes:png,jpg,jpeg|max:255'
        ]);

        $guru = $user->userable;
        if ($request->hasFile('profil_guru')) {
            // Hapus foto lama jika ada
            if ($guru->foto_profile) {
                Storage::disk('public')->delete('profile_guru/' . $guru->foto_profile);
            }

            $file = $request->file('profil_guru');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_guru', $fileName, 'public');
            $guru->foto_profile = $fileName;
            $guru->save();
        }
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function UpdateDetailGuru(Request $request)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:20', Rule::unique('guru', 'nip')->ignore(Auth::user()->userable->id)],
            'alamat' => 'required|string|max:500',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_telp_guru' => 'string',
            'tanggal_lahir_guru' => 'required|date',
            'status_kepegawaian' => 'required|in:tetap,kontrak,honorer',
            'pendidikan_terakhir' => 'required|in:S1,S2,S3',
            'jurusan' => 'nullable|string|max:50',
            'tahun_masuk' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        // Ambil data guru
        $guru = Auth::user()->userable;
        if (!$guru) {
            Log::error('Userable null', ['user_id' => Auth::user()->id]);
            return back()->with('error', 'Data guru tidak ditemukan');
        }

        // Update
        $guru->update([
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp_guru,
            'tanggal_lahir' => $request->tanggal_lahir_guru,
            'status_kepegawaian' => $request->status_kepegawaian,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        $result = $guru->save();

        // Respon
        return $result
            ? back()->with('success', 'Data berhasil diperbarui!')
            : back()->with('info', 'Tidak ada perubahan data');
    }
    public function destroy(string $id)
    {
        //
    }
}
