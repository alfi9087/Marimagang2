<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nim' => 'required|numeric|min:10',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:50',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            User::create($validatedData);

            return redirect('/forms')->with('success', 'Anda Berhasil Registrasi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/forms#register')->withErrors($e->validator->errors())->withInput();
        }
    }
}
