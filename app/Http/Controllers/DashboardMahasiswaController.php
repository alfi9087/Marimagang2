<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pengajuan;
use App\Models\DataBidang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class DashboardMahasiswaController extends Controller
{
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
        $pengajuanSession = Session::get('pengajuan_id');
        $user = User::findOrFail($id);

        $pengajuan = Pengajuan::where('user_id', $user->id)->get();

        if ($pengajuan->isNotEmpty() && $pengajuan[0]->status === 'Magang' && $pengajuan[0]->kesbangpol !== null && $pengajuan[0]->laporan === null) {
            Alert::info('Anda Dinyatakan Magang', 'Silahkan Upload Laporan Akhir Selama Magang')->showConfirmButton();
        } elseif ($pengajuan->isNotEmpty() && $pengajuan[0]->status === 'Magang' && $pengajuan[0]->kesbangpol === null) {
            Alert::info('Pengajuan Anda Diterima', 'Silahkan Upload Berkas Kesbangpol')->showConfirmButton();
        } elseif ($pengajuan->isNotEmpty() && $pengajuan[0]->status === 'Magang' && $pengajuan[0]->kesbangpol !== null && $pengajuan[0]->laporan !== null) {
            Alert::info('Berhasil Upload Semua Berkas', 'Tunggu Verifikasi Admin')->showConfirmButton();
        } else {
        }
        $anggota = Anggota::where('user_id', $user->id)
            ->where('pengajuan_id', $pengajuanSession)
            ->get();

        return view('mahasiswa.pengajuan', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
            'anggota' => $anggota ?? null,
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get(),
        ]);
    }

    public function select_skill($databidang_id)
    {
        $skill = DB::table('skill')->select('id', 'nama as text')->where('databidang_id', $databidang_id)->get();
        $data = ['results' => $skill];
        return $data;
    }
}
