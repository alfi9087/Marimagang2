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
        ], [
            'emaillogin.required' => 'Email field is required',
            'emaillogin.email' => 'Please enter a valid email address',
            'passwordlogin.required' => 'Password field is required',
        ]);

        try {
            if (Auth::guard('web')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {
                $user = Auth::user();

                if ($user->verify == 0) {
                    return redirect('/marimagang/notif');
                }

                $request->session()->regenerate();
                $mahasiswaId = $user->id;
                return redirect('/marimagang/mahasiswa/' . $mahasiswaId);
            }

            if (Auth::guard('admin')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {
                $request->session()->regenerate();
                Session::put('level', 'admin');
                return redirect('/marimagang/dashboardadmin');
            }

            if (Auth::guard('bidang')->attempt(['email' => $credentials['emaillogin'], 'password' => $credentials['passwordlogin']])) {

                $bidang = Auth::guard('bidang')->user();

                $request->session()->regenerate();
                Session::put('level', 'bidang');
                $bidang = $bidang->id;
                return redirect('marimagang/dashboardbidang/' . $bidang);
            }
        } catch (Exception $e) {
            Log::error('Exception during login:', ['message' => $e->getMessage()]);
        }

        return back()->with('loginError', 'Login Gagal!')->with('loginErrorDetails', 'Email atau Password Anda Salah');
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
        return redirect('/marimagang/forms');
    }
}
