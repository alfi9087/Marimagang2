<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;

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
}
