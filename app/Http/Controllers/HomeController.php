<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Menampilkan Landing Page Website 
    public function home()
    {
        return view('home.index', [
            'title' => 'Home',
        ]);
    }
}
