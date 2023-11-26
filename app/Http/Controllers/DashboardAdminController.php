<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\SkillUser;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('dashboardadmin.index', [
            'title' => 'Home',
        ]);
    }

    public function admin()
    {
        return view('dashboardadmin.admin.index', [
            'title' => 'Home',
            'admin' => DB::table('admins')->get()
        ]);
    }

    public function user()
    {
        return view('dashboardadmin.mahasiswa.index', [
            'title' => 'User',
            'user' => DB::table('users')->get()
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.anggota', 'user.skilluser', 'user.skilluser.skill.databidang')->findOrFail($id);
        return view('dashboardadmin.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function pengajuan()
    {

        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diproses')
            ->get();

        return view('dashboardadmin.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get()
        ]);
    }

    public function diteruskan()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->get();

        return view('dashboardadmin.pengajuan.diteruskan', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function konfirmasi()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Diterima', 'Ditolak'])
            ->get();

        return view('dashboardadmin.pengajuan.konfirmasi', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function magang()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
            ->get();

        return view('dashboardadmin.pengajuan.magang', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }
}
