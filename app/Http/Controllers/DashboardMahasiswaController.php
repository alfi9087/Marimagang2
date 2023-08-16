<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardMahasiswaController extends Controller
{
    //Menampilkan Dashboard Mahasiswa
    public function index($id)
    {
        $user = User::findorfail($id);

        if (!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon || !$user->foto) {
            Alert::info('Lengkapi Profil', 'Upload Berkas Setelah Anda Melengkapi Profil')->showConfirmButton();
        }

        return view('mahasiswa.index', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
        ]);
    }
}
