<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    //Menampilkan Dashboard
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Home',
        ]);
    }
}
