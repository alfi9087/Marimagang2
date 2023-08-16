<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    public function store(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'nama' => 'required',
            'kampus' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $photoPath = $foto->move(public_path('mahasiswa'), $foto->getClientOriginalName())->getPathname();
            $photoPath = 'mahasiswa/' . $foto->getClientOriginalName();
        }

        $user->nama = $request->input('nama');
        $user->kampus = $request->input('kampus');
        $user->jurusan = $request->input('jurusan');
        $user->prodi = $request->input('prodi');
        $user->telepon = $request->input('telepon');
        $user->foto = $photoPath;
        $user->save();

        // Tambahkan SweetAlert success message
        Alert::success('Sukses', 'Data Profil Berhasil Ditambahkan')->showConfirmButton();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'nama' => 'required',
            'kampus' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $user->nama = $request->input('nama');
        $user->kampus = $request->input('kampus');
        $user->jurusan = $request->input('jurusan');
        $user->prodi = $request->input('prodi');
        $user->telepon = $request->input('telepon');

        $user->save();

        Alert::warning('Sukses', 'Data Profil Berhasil Diperbarui')->showConfirmButton();

        return redirect()->back();
    }
}
