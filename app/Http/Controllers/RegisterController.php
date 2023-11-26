<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'nim' => 'required|numeric|regex:/^[0-9]{1,10}$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:50',
        ]);

        $ValidatedData['password'] = bcrypt($ValidatedData['password']);

        User::create($ValidatedData);

        return redirect('/forms')->with('success', 'Anda Berhasil Registrasi');
    }
}
