<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user_validasi = User::where('email', $request->email)->first();


        if ($user_validasi && $user_validasi->sedang_login) {
            return back()->withErrors(['email' => 'Akun ini sedang digunakan di perangkat lain.'])->onlyInput('email');
        }

        //Ambil session
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            // Ambil Role User
            $user->update(['sedang_login' => true]);

            $role = $user->role;

            // Redirect Berdasarkan Role
            if ($role === 'admin') {
                return redirect()->route('admindash.index');
            } elseif ($role === 'siswa') {
                return redirect()->route('dashboardsiswa.index');
            } elseif ($role === 'guru') {
                return redirect()->route('gurudash.index');
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Role tidak dikenali']);
            }
        }

        if (!$user_validasi) {

            return back()->withErrors(['email' => 'Email tidak ditemukan'])->onlyInput('email');
        } else {

            return back()->withErrors(['password' => 'Password tidak ditemukan'])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->update(['sedang_login' => false]);
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginform');
    }
}
