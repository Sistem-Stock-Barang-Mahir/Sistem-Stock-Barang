<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            if (Auth::user()->role === 'admin') {
                // Jika pengguna adalah admin, arahkan ke halaman dashboard admin
                return redirect()->route('admin.dashboard');
            } else {
                // Jika pengguna adalah staff, arahkan ke halaman dashboard staff
                return redirect()->route('staff.dashboard');
            }
        }

        // Autentikasi gagal
        return redirect()->back()->withErrors(['email' => 'Email atau kata sandi salah.']);
    }
}
