<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;

class HomeController extends Controller
{
    //Menampilkan Landing Page Website 
    public function home()
    {
        return view('home.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->get()
        ]);
    }

    //Menampilkan Detail Tiap Bidang
    public function detail($id)
    {
        $databidang = DataBidang::findOrFail($id);

        // Mengambil keterampilan terkait dengan bidang tertentu
        $skill = $databidang->skill;
        return view('home.detail', [
            'title' => 'Home',
            'databidang' => $databidang,
            'skill' => $skill
        ]);
    }
}
