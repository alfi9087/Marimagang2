<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // Function Menambah Akun Mahasiswa
    public function store(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                // Jika pengguna dengan ID yang diberikan tidak ditemukan
                // Tampilkan pesan kesalahan dan berikan respons yang sesuai
                Alert::error('Error', 'Pengguna tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $request->validate([
                'nama' => 'required|string|max:70',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:100',
                'jurusan' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:100',
                'prodi' => 'required|max:100',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $photoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa'); // 'local' sesuai dengan nama penyimpanan yang telah Anda konfigurasi
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
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    // Function Update Data Mahasiswa
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                // Jika pengguna dengan ID yang diberikan tidak ditemukan
                // Tampilkan pesan kesalahan dan berikan respons yang sesuai
                Alert::error('Error', 'Pengguna tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $request->validate([
                'nama' => 'required|string|max:70',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:100',
                'jurusan' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:100',
                'prodi' => 'required|max:100',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $user->nama = $request->input('nama');
            $user->kampus = $request->input('kampus');
            $user->jurusan = $request->input('jurusan');
            $user->prodi = $request->input('prodi');
            $user->telepon = $request->input('telepon');

            // Update gambar jika ada unggahan gambar baru
            if ($request->hasFile('foto')) {
                // Hapus gambar lama jika ada
                if ($user->foto) {
                    Storage::delete($user->foto);
                }

                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa');
                $user->foto = $photoPath;
            }

            $user->save();

            Alert::warning('Sukses', 'Data Profil Berhasil Diperbarui')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    public function verify(Request $request, $id)
    {

        $user = User::find($id);
        if ($user) {
            $user->verify = '1';
            $user->save();
            toast('Akun Mahasiswa Berhasil Diverifikasi', 'success');
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
