<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\DataBidang;
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

    public function pengajuan($id)
    {
        $user = User::findorfail($id);

        return view('mahasiswa.pengajuan', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get()
        ]);
    }

    public function select_skill($databidang_id)
    {
        $skill = DB::table('skill')->select('id', 'nama as text')->where('databidang_id', $databidang_id)->get();
        $data = ['results' => $skill];
        return $data;
    }
}
