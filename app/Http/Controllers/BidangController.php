<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bidang;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
    // Function Menambah Akun Admin
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|max:70',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:8'
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            Bidang::create($validatedData);

            // Alert
            Alert::success('Sukses', 'Data Akun Bidang Berhasil Ditambahkan')->showConfirmButton();

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
                'nama' => 'required|max:70',
                'email' => 'email:dns|unique:admins,email,' . $id,
            ]);

            $bidang = Bidang::find($id);

            if (!$bidang) {
                // Jika admin dengan ID yang diberikan tidak ditemukan
                // Tampilkan pesan kesalahan dan berikan respons yang sesuai
                Alert::error('Error', 'Admin tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            // Bandingkan data lama dan data baru
            $oldNama = $bidang->nama;
            $oldEmail = $bidang->email;

            $bidang->nama = $request->nama;
            $bidang->email = $request->email;
            $bidang->save();

            // Cek Kondisi
            if ($bidang->nama !== $oldNama || $bidang->email !== $oldEmail) {
                // Alert
                Alert::success('Sukses', 'Data Akun Bidang Berhasil Diperbarui')->showConfirmButton();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    // Function Delete Akun Bidang
    public function delete(Request $request)
    {
        Bidang::destroy($request->id);

        // Alert
        Alert::success('Sukses', 'Data Bidang Berhasil Dihapus')->showConfirmButton();

        return redirect()->back();
    }
}
