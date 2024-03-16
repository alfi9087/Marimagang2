<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'emaillogin' => ['required', 'email'],
            'passwordlogin' => ['required'],
        ]);

        try {
            if (Auth::guard('web')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {
                $user = Auth::user();

                if ($user->verify == 0) {
                    return redirect('/notif');
                }

                $request->session()->regenerate();
                $mahasiswaId = $user->id;
                return redirect('/mahasiswa/' . $mahasiswaId);
            }

            if (Auth::guard('admin')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {
                $request->session()->regenerate();
                Session::put('level', 'admin');
                return redirect('/dashboard');
            }

            if (Auth::guard('bidang')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {

                $bidang = Auth::guard('bidang')->user();

                $request->session()->regenerate();
                Session::put('level', 'bidang');
                $bidang = $bidang->id;
                return redirect('/dashboardbidang/' . $bidang);
            }
        } catch (Exception $e) {
            Log::error('Exception during login:', ['message' => $e->getMessage()]);
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
