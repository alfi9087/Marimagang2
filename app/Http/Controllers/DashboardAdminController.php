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
            'sekretariat' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%sekretariat%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'aptika' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%aptika%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'statistik' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%statistik%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'infrastruktur' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%infrastruktur%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'komunikasi' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%komunikasi%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'diproses' => DB::table('pengajuan')->where('status', 'Diproses')->count(),
            'diteruskan' => DB::table('pengajuan')->where('status', 'Diteruskan')->count(),
            'diterima' => DB::table('pengajuan')->where('status', 'Diterima')->count(),
            'ditolak' => DB::table('pengajuan')->where('status', 'Ditolak')->count(),
            'magang' => DB::table('pengajuan')->where('status', 'Magang')->count(),
            'selesai' => DB::table('pengajuan')->where('status', 'Selesai')->count(),
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
