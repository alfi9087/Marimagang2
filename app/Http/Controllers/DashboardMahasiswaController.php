<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pengajuan;
use App\Models\DataBidang;
use App\Models\Riwayat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class DashboardMahasiswaController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        $pengajuan = Pengajuan::where('user_id', $user->id)->get();
        $pengajuanExists = !$pengajuan->isEmpty();


        $riwayat = Riwayat::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('mahasiswa.index', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
            'riwayat' => $riwayat
        ]);
    }

    public function pengajuan(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $pengajuan = Pengajuan::where('user_id', $user->id)->get();

        foreach ($pengajuan as $p) {
            if ($p->status === 'Magang' && $p->kesbangpol !== null && $p->laporan === null) {
                Alert::info('Anda Dinyatakan Magang', 'Silahkan Upload Laporan Akhir Selama Magang')->showConfirmButton();
            } elseif ($p->status === 'Diterima' && $p->kesbangpol === null) {
                Alert::info('Pengajuan Anda Diterima', 'Silahkan Upload Berkas Kesbangpol')->showConfirmButton();
            }
        }

        $anggota = Anggota::where('user_id', $user->id)
            ->get();

        return view('mahasiswa.pengajuan', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
            'anggota' => $anggota ?? null,
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get(),
        ]);
    }

    public function anggota(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $pengajuan = $request->query('id_pengajuan');

        $anggota = Anggota::where('pengajuan_id', $pengajuan)
            ->get();


        if ($anggota->isEmpty()) {
            Alert::info('Selamat Datang', 'Kelola Data Anggota Magang Anda')->showConfirmButton();
        }

        return view('mahasiswa.anggota', [
            'title' => 'Dashboard Mahasiswa',
            'anggota' => $anggota ?? null,
            'pengajuan' => $pengajuan,
            'user' => $user,
        ]);
    }

    public function logbook(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $pengajuan = $request->query('id_pengajuan');

        $anggota = Anggota::where('pengajuan_id', $pengajuan)->get();
        $pengajuanId = Pengajuan::findOrFail($pengajuan);

        $tanggallogbook = $pengajuanId->tanggallogbook;

        return view('mahasiswa.logbook', [
            'title' => 'Dashboard Mahasiswa',
            'anggota' => $anggota ?? null,
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get(),
            'user' => $user,
            'tanggallogbook' => $tanggallogbook,
            'logbook' => DB::table('logbooks')->get(),
        ]);
    }

    public function select_skill($databidang_id)
    {
        $skill = DB::table('skill')->select('id', 'nama as text')->where('databidang_id', $databidang_id)->get();
        $data = ['results' => $skill];
        return $data;
    }
}
