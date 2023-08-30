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
        $ValidatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|unique:admins',
            'password' => 'required|min:8'
        ]);

        $ValidatedData['password'] = bcrypt($ValidatedData['password']);

        Admin::create($ValidatedData);

        // Alert
        Alert::success('Sukses', 'Data admin Berhasil Ditambahkan')->showConfirmButton();

        return redirect()->back();
    }

    // Function Update Akun Admin
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'max:255',
            'email' => 'email:dns|unique:admins,email,' . $id,
        ]);

        $admin = Admin::find($id);

        // Bandingkan data lama dan data baru
        $oldNama = $admin->nama;
        $oldEmail = $admin->email;

        $admin->nama = $request->nama;
        $admin->email = $request->email;
        $admin->save();

        // Cek Kondisi
        if ($admin->nama !== $oldNama || $admin->email !== $oldEmail) {
            // Alert
            Alert::success('Sukses', 'Data admin Berhasil Diperbarui')->showConfirmButton();
        }

        return redirect()->back();
    }

    // Function Delete Akun Admin
    public function delete(Request $request)
    {
        Admin::destroy($request->id);

        // Alert
        Alert::success('Sukses', 'Data admin Berhasil Dihapus')->showConfirmButton();

        return redirect()->back();
    }
}
