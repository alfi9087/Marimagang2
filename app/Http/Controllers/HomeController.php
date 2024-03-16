<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->get(),
            'jumlahuser' => DB::table('users')->where('verify', 1)->count(),
            'jumlahdatabidang' => DB::table('databidang')->count(),
            'jumlahpengajuan' => DB::table('pengajuan')->count(),
            'jumlahmagang' => DB::table('pengajuan')->whereIn('status', ['Magang', 'Selesai'])->count(),
            'pengajuan' => DB::table('pengajuan')->get()
        ]);
    }

    public function detail($id)
    {
        $databidang = DataBidang::findOrFail($id);

        $skill = $databidang->skill;
        return view('home.detail', [
            'title' => 'Home',
            'databidang' => $databidang,
            'skill' => $skill
        ]);
    }
}
