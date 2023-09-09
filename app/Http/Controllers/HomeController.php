<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bidang;

class HomeController extends Controller
{
    //Menampilkan Landing Page Website 
    public function home()
    {
        return view('home.index', [
            'title' => 'Home',
            'bidang' => DB::table('bidang')->get()
        ]);
    }

    //Menampilkan Detail Tiap Bidang
    public function detail($id)
    {
        $bidang = Bidang::findorfail($id);
        return view('home.detail', [
            'title' => 'Home',
            'bidang' => $bidang,
        ]);
    }
}
