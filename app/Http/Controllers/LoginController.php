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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::guard('web')->attempt($credentials)) {
                $user = Auth::user();

                if ($user->verify == 0) {
                    // User is not verified, redirect to notification page
                    return redirect('/notif');
                }

                $request->session()->regenerate();
                $mahasiswaId = $user->id;
                return redirect('/mahasiswa/' . $mahasiswaId);
            }

            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                Session::put('level', 'admin');
                return redirect('/dashboard');
            }

            if (Auth::guard('bidang')->attempt($credentials)) {
                $request->session()->regenerate();
                $dtbidag = DB::table('bidangs')->where('email', $credentials['email'])->get();
                foreach ($dtbidag as $d){
                    $id_b = $d->id_bidang;
                }
                Session::put('id_bidang', $id_b);
                Session::put('level', 'bidang');
                return redirect('/dashboardbidang');
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
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
