<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileAdminControlller extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profileadmin', [
            'admin' => $admin,
        ]);
    }

    public function updatedataAkun(Request $request)
    {
        /** @var \App\Models\User */
        $admin = Auth::user();

        $dataAdmin = $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->userable->nama = $dataAdmin['nama'];
        $admin->email = $dataAdmin['email'];
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            $admin->password = bcrypt($dataAdmin['password']);
        }

        $admin->save();
        $admin->userable->save();

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function updateProfileAdmin(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'profil_admin' => 'nullable|image|mimes:png,jpg,jpeg|max:255'
        ]);

        $admin = $user->userable;
        if ($request->hasFile('profil_admin')) {
            // Hapus foto lama jika ada
            if ($admin->foto_profile) {
                Storage::disk('public')->delete('profile_admin/' . $admin->foto_profile);
            }

            $file = $request->file('profil_admin');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_admin', $fileName, 'public');
            $admin->foto_profile = $fileName;
            $admin->save();
        }
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
