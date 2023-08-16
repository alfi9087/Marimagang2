<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    //Menampilkan Detail Tiap Bidang
    public function index()
    {
        return view('home.detail', [
            'title' => 'Home',
        ]);
    }
}
