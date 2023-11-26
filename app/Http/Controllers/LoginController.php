<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    protected function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();
                $mahasiswaId = Auth::user()->id;
                return redirect('/mahasiswa/' . $mahasiswaId);
            }
        } catch (\Illuminate\Auth\AuthenticationException $e) {
        }

        try {
            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/dashboard');
            }
        } catch (\Illuminate\Auth\AuthenticationException $e) {
        }

        try {
            if (Auth::guard('bidang')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/dashboardbidang');
            }
        } catch (\Illuminate\Auth\AuthenticationException $e) {
        }

        return back()->with('loginError', 'Login Gagal! Anda Belum Registrasi');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('bidang')->check()) {
            Auth::guard('bidang')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/forms');
    }
}
