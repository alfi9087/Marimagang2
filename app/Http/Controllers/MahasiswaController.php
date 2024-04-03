<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'jurusan' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'prodi' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ], [
                'nama.required' => 'Nama field is required',
                'nama.regex' => 'Nama field must contain only letters, numbers, and spaces',
                'nama.max' => 'Nama field may not be greater than 60 characters',
                'kampus.required' => 'Kampus field is required',
                'kampus.regex' => 'Kampus field must contain only letters, numbers, spaces, hyphens, and underscores',
                'kampus.max' => 'Kampus field may not be greater than 60 characters',
                'jurusan.required' => 'Jurusan field is required',
                'jurusan.regex' => 'Jurusan field must contain only letters, numbers, spaces, hyphens, and underscores',
                'jurusan.max' => 'Jurusan field may not be greater than 60 characters',
                'prodi.required' => 'Prodi field is required',
                'prodi.regex' => 'Prodi field must contain only letters, numbers, and spaces',
                'prodi.max' => 'Prodi field may not be greater than 60 characters',
                'telepon.required' => 'Telepon field is required',
                'telepon.regex' => 'Telepon field must contain only numbers, spaces, hyphens, and plus symbols',
                'telepon.min' => 'Telepon field must be at least 10 characters',
                'telepon.max' => 'Telepon field may not be greater than 13 characters',
                'foto.image' => 'Foto must be an image',
                'foto.mimes' => 'Foto must be a file of type: jpeg, png, jpg, svg',
                'foto.max' => 'Foto may not be greater than 2 MB',
            ]);

            $photoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa');
            }

            $user->nama = $request->input('nama');
            $user->kampus = $request->input('kampus');
            $user->jurusan = $request->input('jurusan');
            $user->prodi = $request->input('prodi');
            $user->telepon = $request->input('telepon');
            $user->foto = $photoPath;
            $user->save();

            Alert::success('Sukses', 'Data Profil Berhasil Ditambahkan')->showConfirmButton();

            $message = 'Anda Berhasil Melengkapi Profil';
            Log::channel('notification')->info($message);

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                Alert::error('Error', 'Pengguna tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'jurusan' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'prodi' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ], [
                'nama.required' => 'Nama field is required',
                'nama.regex' => 'Nama field must contain only letters, numbers, and spaces',
                'nama.max' => 'Nama field may not be greater than 60 characters',
                'kampus.required' => 'Kampus field is required',
                'kampus.regex' => 'Kampus field must contain only letters, numbers, spaces, hyphens, and underscores',
                'kampus.max' => 'Kampus field may not be greater than 60 characters',
                'jurusan.required' => 'Jurusan field is required',
                'jurusan.regex' => 'Jurusan field must contain only letters, numbers, spaces, hyphens, and underscores',
                'jurusan.max' => 'Jurusan field may not be greater than 60 characters',
                'prodi.required' => 'Prodi field is required',
                'prodi.regex' => 'Prodi field must contain only letters, numbers, and spaces',
                'prodi.max' => 'Prodi field may not be greater than 60 characters',
                'telepon.required' => 'Telepon field is required',
                'telepon.regex' => 'Telepon field must contain only numbers, spaces, hyphens, and plus symbols',
                'telepon.min' => 'Telepon field must be at least 10 characters',
                'telepon.max' => 'Telepon field may not be greater than 13 characters',
                'foto.image' => 'Foto must be an image',
                'foto.mimes' => 'Foto must be a file of type: jpeg, png, jpg, svg',
                'foto.max' => 'Foto may not be greater than 2 MB',
            ]);

            if (
                $user->nama == $request->input('nama') &&
                $user->kampus == $request->input('kampus') &&
                $user->jurusan == $request->input('jurusan') &&
                $user->prodi == $request->input('prodi') &&
                $user->telepon == $request->input('telepon') &&
                !$request->hasFile('foto')
            ) {
                Alert::info('', 'Profil Tidak Diperbarui')->showConfirmButton();
                return redirect()->back();
            }

            $user->nama = $request->input('nama');
            $user->kampus = $request->input('kampus');
            $user->jurusan = $request->input('jurusan');
            $user->prodi = $request->input('prodi');
            $user->telepon = $request->input('telepon');

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    Storage::delete($user->foto);
                }

                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa');
                $user->foto = $photoPath;
            }

            $user->save();

            Alert::warning('Sukses', 'Data Profil Berhasil Diperbarui')->showConfirmButton();

            $message = 'Anda Berhasil Memperbarui Profil';
            Log::channel('notification')->info($message);

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function verify(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->verify = '1';
            $user->save();
            toast('Akun Mahasiswa Berhasil Diverifikasi', 'success');
            $message = 'Akun Anda Berhasil Diverifikasi Admin';
            Log::channel('notification')->info($message);
        }

        return redirect()->back();
    }

    public function block(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->verify = '0';
            $user->save();
            toast('Akun Mahasiswa Tidak Terverifikasi', 'error');
        }

        return redirect()->back();
    }
}
