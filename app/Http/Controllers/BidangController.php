<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'deskripsi' => 'required',
                'skill.*' => 'required', // Validasi untuk setiap keterampilan
            ]);

            $thumbnailPath = $request->file('thumbnail')->store('bidang/thumbnails');
            $photoPath = $request->file('photo')->store('bidang/photos');

            $bidang = new Bidang;
            $bidang->nama = $validatedData['nama'];
            $bidang->thumbnail = $thumbnailPath;
            $bidang->photo = $photoPath;
            $bidang->deskripsi = $validatedData['deskripsi'];
            $bidang->status = 'Buka';

            $bidang->save();

            // Simpan setiap keterampilan sebagai baris terpisah di tabel "skills"
            foreach ($validatedData['skill'] as $skillName) {
                $skill = new Skill;
                $skill->nama = $skillName;
                $skill->bidang_id = $bidang->id;
                $skill->save();
            }

            // Tambahkan SweetAlert success message
            Alert::success('Sukses', 'Data Bidang Berhasil Ditambahkan')->showConfirmButton();

            // Redirect atau berikan respons yang sesuai, misalnya:
            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }

    public function open(Request $request, $id)
    {

        $bidang = Bidang::find($id);
        if ($bidang) {
            $bidang->status = 'Buka';
            $bidang->save();
            toast('Bidang Berhasil Dibuka', 'success');
        }

        return redirect()->back();
    }

    public function close(Request $request, $id)
    {
        $bidang = Bidang::find($id);
        if ($bidang) {
            $bidang->status = 'Tutup';
            $bidang->save();
            toast('Bidang Berhasil Ditutup', 'error');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            // Temukan bidang berdasarkan ID
            $bidang = Bidang::find($id);

            if (!$bidang) {
                // Jika bidang tidak ditemukan, tampilkan pesan kesalahan
                Alert::error('Error', 'Data Bidang tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            // Hapus gambar thumbnail dan photo terkait bidang
            if ($bidang->thumbnail) {
                Storage::delete($bidang->thumbnail);
            }

            if ($bidang->photo) {
                Storage::delete($bidang->photo);
            }

            // Hapus bidang
            $bidang->delete();

            // Hapus juga semua skill terkait dengan bidang ini (jika diperlukan)
            // $bidang->skills()->delete();

            // Tampilkan pesan sukses
            toast('Data Bidang Berhasil Dihapus', 'success');

            // Redirect atau berikan respons yang sesuai
            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan menampilkan pesan error
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();

            // Redirect atau berikan respons yang sesuai untuk menangani kesalahan
            return redirect()->back();
        }
    }
}
