<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    //Menampilkan Dashboard Admin
    public function index()
    {
        return view('dashboardadmin.index', [
            'title' => 'Home',
        ]);
    }

    //Menampilkan Tabel Admin
    public function admin()
    {
        return view('dashboardadmin.admin.index', [
            'title' => 'Home',
            'admin' => DB::table('admins')->get()
        ]);
    }

    //Menampilkan Tabel Mahasiswa
    public function user()
    {
        return view('dashboardadmin.mahasiswa.index', [
            'title' => 'User',
            'user' => DB::table('users')->get()
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.anggota', 'user.skilluser')->findOrFail($id);
        return view('dashboardadmin.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
        ]);
    }

    //Menampilkan Dashboard Pengajuan
    public function pengajuan()
    {
        $pengajuan = Pengajuan::with('user')->get();

        return view('dashboardadmin.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }
}
