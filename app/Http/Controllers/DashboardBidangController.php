<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\Bidang;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardBidangController extends Controller
{
    public function index()
    {
        return view('dashboardbidang.index', [
            'title' => 'Home',
        ]);
    }

    public function bidang()
    {
        return view('dashboardbidang.bidang.index', [
            'title' => 'Home',
            'bidang' => DB::table('bidangs')->get()
        ]);
    }

    public function databidang()
    {
        return view('dashboardbidang.databidang.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->get()
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
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->get();

        return view('dashboardbidang.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }
}
