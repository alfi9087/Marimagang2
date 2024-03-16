<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\SkillUser;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

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
            'admin' => DB::table('admins')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function user()
    {
        return view('dashboardadmin.mahasiswa.index', [
            'title' => 'User',
            'user' => DB::table('users')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.skilluser', 'user.skilluser.skill.databidang')->findOrFail($id);
        $anggota = Anggota::where('pengajuan_id', $pengajuan->id)->get();
        return view('dashboardadmin.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
            'anggota' => $anggota,
        ]);
    }

    public function pengajuan()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diproses')->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get()
        ]);
    }

    public function getSkills($pengajuanId)
    {
        $skills = SkillUser::where('pengajuan_id', $pengajuanId)
            ->with('skill')
            ->get();

        return response()->json($skills);
    }


    public function diteruskan()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.diteruskan', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function konfirmasi()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Diterima', 'Ditolak'])
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.konfirmasi', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function magang()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
            ->orderBy('pengajuan.status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin.pengajuan.magang', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function select_skill($databidang_id)
    {
        $skill = DB::table('skill')->select('id', 'nama as text')->where('databidang_id', $databidang_id)->get();
        $data = ['results' => $skill];
        return $data;
    }

    public function pdfadmin()
    {
        $pengajuan = Pengajuan::whereIn('status', ['Magang', 'Selesai'])
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('dashboardadmin.pengajuan.pdf', compact('pengajuan')));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream('pengajuan.pdf');
    }
}
