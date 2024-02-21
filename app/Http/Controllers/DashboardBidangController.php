<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\Bidang;
use App\Models\Pengajuan;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardBidangController extends Controller
{
    public function index($id)
    {
        $bidang = Bidang::findorfail($id);

        return view('dashboardbidang.index', [
            'title' => 'Home',
            'bidang' => $bidang,
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
        ]);
    }

    public function bidang($id)
    {
        $bidang = Bidang::findorfail($id);
        $bidangs = DB::table('bidangs')->orderBy('created_at', 'desc')->get();
        return view('dashboardbidang.bidang.index', [
            'title' => 'Home',
            'bidang' => $bidang,
            'bidangs' => $bidangs
        ]);
    }

    public function databidang($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('dashboardbidang.databidang.index', [
            'title' => 'Home',
            'bidang' => $bidang,
            'databidang' => DB::table('databidang')->where('bidang_id', $bidang->id)->get()
        ]);
    }

    public function detail($id)
    {
        $bidang = Bidang::findOrFail($id);
        $databidang = DataBidang::findOrFail($id);

        $skill = $databidang->skill;
        return view('dashboardbidang.databidang.detail', [
            'title' => 'Landing Page',
            'databidang' => $databidang,
            'bidang' => $bidang,
            'skill' => $skill
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.skilluser')->findOrFail($id);
        $anggota = Anggota::where('pengajuan_id', $pengajuan->id)->get();
        $bidang = Bidang::findOrFail($id);
        return view('dashboardbidang.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
            'bidang' => $bidang,
            'anggota' => $anggota,
        ]);
    }

    public function pengajuan($id)
    {
        $databidangId = DataBidang::where('bidang_id', $id)->value('id');

        if (!$databidangId) {
            abort(404, 'DataBidang tidak ditemukan');
        }

        $bidang = Bidang::findOrFail($id);
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->where('pengajuan.databidang_id', $databidangId)
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardbidang.pengajuan.index', [
            'title' => 'Pengajuan',
            'bidang' => $bidang,
            'pengajuan' => $pengajuan,
        ]);
    }
}
