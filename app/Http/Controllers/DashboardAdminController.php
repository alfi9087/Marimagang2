<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Bidang;

class DashboardAdminController extends Controller
{
    //Menampilkan Dashboard Admin
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Home',
        ]);
    }

    //Menampilkan Tabel Admin
    public function admin()
    {
        return view('dashboard.admin.index', [
            'title' => 'Home',
            'admin' => DB::table('admins')->get()
        ]);
    }

    //Menampilkan Tabel Mahasiswa
    public function user()
    {
        return view('dashboard.mahasiswa.index', [
            'title' => 'User',
            'user' => DB::table('users')->get()
        ]);
    }

    //Menampilkan Kelola Landing Page
    public function home()
    {
        return view('dashboard.home.index', [
            'title' => 'Landing Page',
            'bidang' => DB::table('bidang')->get()
        ]);
    }

    public function detail($id)
    {
        $bidang = Bidang::findorfail($id);
        return view('dashboard.home.detail', [
            'title' => 'Landing Page',
            'bidang' => $bidang,
        ]);
    }
}
