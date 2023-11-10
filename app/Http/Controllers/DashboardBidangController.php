<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\Bidang;

class DashboardBidangController extends Controller
{
    //Menampilkan Dashboard Admin
    public function index()
    {
        return view('dashboardbidang.index', [
            'title' => 'Home',
        ]);
    }

    //Menampilkan Tabel Bidang
    public function bidang()
    {
        return view('dashboardbidang.bidang.index', [
            'title' => 'Home',
            'bidang' => DB::table('bidangs')->get()
        ]);
    }

    //Menampilkan Data Bidang
    public function databidang()
    {
        return view('dashboardbidang.databidang.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->get()
        ]);
    }

    // Detail Bidang
    public function detail($id)
    {
        $databidang = DataBidang::findOrFail($id);

        // Mengambil keterampilan terkait dengan bidang tertentu
        $skill = $databidang->skill;
        return view('dashboardbidang.databidang.detail', [
            'title' => 'Landing Page',
            'databidang' => $databidang,
            'skill' => $skill
        ]);
    }
}
