<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Sesuaikan dengan aturan validasi yang sesuai
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Sesuaikan dengan aturan validasi yang sesuai
            'deskripsi' => 'required',
        ]);

        // Inisialisasi variabel untuk path thumbnail dan photo
        $thumbnailPath = null;
        $photoPath = null;

        // Periksa apakah file thumbnail diunggah
        if ($request->file('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('bidang/thumbnails'); // Sesuaikan dengan direktori penyimpanan yang sesuai
        }

        // Periksa apakah file photo diunggah
        if ($request->file('photo')) {
            $photoPath = $request->file('photo')->store('bidang/photos'); // Sesuaikan dengan direktori penyimpanan yang sesuai
        }

        // Simpan data ke dalam database menggunakan model Bidang
        $bidang = new Bidang();
        $bidang->nama = $validatedData['nama'];
        $bidang->thumbnail = $thumbnailPath;
        $bidang->photo = $photoPath;
        $bidang->deskripsi = $validatedData['deskripsi'];
        $bidang->save();

        // Tambahkan SweetAlert success message
        Alert::success('Sukses', 'Data Bidang Berhasil Ditambahkan')->showConfirmButton();

        // Redirect atau berikan respons yang sesuai, misalnya:
        return redirect()->back();
    }
}
