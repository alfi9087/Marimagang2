<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{
    //Menampilkan Halaman Form
    public function form()
    {
        return view('forms.index', [
            'title' => 'Forms',
        ]);
    }
}
