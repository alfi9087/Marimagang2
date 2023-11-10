<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    // Function Menambah Akun Admin
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:8|max:50',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            Admin::create($validatedData);

            // Alert
            Alert::success('Sukses', 'Data Admin Berhasil Ditambahkan')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    // Function Update Akun Admin
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'email' => 'email:dns|unique:admins,email,' . $id,
            ]);

            $admin = Admin::find($id);

            if (!$admin) {
                // Jika admin dengan ID yang diberikan tidak ditemukan
                // Tampilkan pesan kesalahan dan berikan respons yang sesuai
                Alert::error('Error', 'Admin tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            // Bandingkan data lama dan data baru
            $oldNama = $admin->nama;
            $oldEmail = $admin->email;

            $admin->nama = $request->nama;
            $admin->email = $request->email;
            $admin->save();

            // Cek Kondisi
            if ($admin->nama !== $oldNama || $admin->email !== $oldEmail) {
                // Alert
                Alert::success('Sukses', 'Data Admin Berhasil Diperbarui')->showConfirmButton();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    // Function Delete Akun Admin
    public function delete(Request $request)
    {
        Admin::destroy($request->id);

        // Alert
        Alert::success('Sukses', 'Data Admin Berhasil Dihapus')->showConfirmButton();

        return redirect()->back();
    }
}
