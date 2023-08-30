<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

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
}
