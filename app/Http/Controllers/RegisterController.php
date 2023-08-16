<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //Memvalidasi dan Menyimpan Data Register
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'nim' => 'required|max:10',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $ValidatedData['password'] = bcrypt($ValidatedData['password']);

        User::create($ValidatedData);

        return redirect('/forms')->with('success', 'Anda Berhasil Registrasi');
    }
}
