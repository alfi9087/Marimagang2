<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimVerifikasi;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nim' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:50',
            ], [
                'nim.required' => 'NIM field is required',
                'nim.unique' => 'NIM has already been taken',
                'email.required' => 'Email field is required',
                'email.email' => 'Please enter a valid email address',
                'email.unique' => 'Email has already been taken',
                'password.required' => 'Password field is required',
                'password.min' => 'Password must be at least 8 characters',
                'password.max' => 'Password may not be greater than 50 characters',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            Mail::to($user->email)->send(new KirimVerifikasi($user));

            return redirect('/forms#login')->with('success', 'Anda Berhasil Registrasi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/forms#register')->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect('/forms#register')->withInput();
        }
    }
}
