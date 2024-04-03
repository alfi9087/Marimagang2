<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bidang;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
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

            Alert::success('Sukses', 'Data Akun Bidang Berhasil Ditambahkan')->showConfirmButton();

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
            $request->validate([
                'nama' => 'required|max:70',
                'email' => 'email:dns|unique:admins,email,' . $id,
            ]);

            $bidang = Bidang::find($id);

            if (!$bidang) {
                Alert::error('Error', 'Admin tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $oldNama = $bidang->nama;
            $oldEmail = $bidang->email;

            $bidang->nama = $request->nama;
            $bidang->email = $request->email;
            $bidang->save();

            if ($bidang->nama !== $oldNama || $bidang->email !== $oldEmail) {
                Alert::success('Sukses', 'Data Akun Bidang Berhasil Diperbarui')->showConfirmButton();
            }

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            Bidang::destroy($request->id);
            Alert::success('Sukses', 'Data Bidang Berhasil Dihapus')->showConfirmButton();
            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }
}
