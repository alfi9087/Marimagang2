<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\Bidang;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardBidangController extends Controller
{
    public function index()
    {
        return view('dashboardbidang.index', [
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
        ]);
    }

    public function bidang()
    {
        return view('dashboardbidang.bidang.index', [
            'title' => 'Home',
            'bidang' => DB::table('bidangs')->get()
        ]);
    }

    public function databidang(Request $request)
    {
        $bidang = Session::get('id_bidang');
        return view('dashboardbidang.databidang.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->where('id', $bidang)->get()
        ]);
    }

    public function detail($id)
    {
        $databidang = DataBidang::findOrFail($id);

        $skill = $databidang->skill;
        return view('dashboardbidang.databidang.detail', [
            'title' => 'Landing Page',
            'databidang' => $databidang,
            'skill' => $skill
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.anggota', 'user.skilluser')->findOrFail($id);
        return view('dashboardbidang.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function pengajuan()
    {
        $bidang = Session::get('id_bidang');
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->where('pengajuan.databidang_id', $bidang)
            ->get();

        return view('dashboardbidang.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }
}
