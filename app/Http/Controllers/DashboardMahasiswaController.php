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
        // Path to the log file
        $logPath = storage_path('logs/notification.log');

        // Check if the log file exists
        if (File::exists($logPath)) {
            // Read the contents of the log file
            $logsContent = File::get($logPath);

            // Separate log entries by newline
            $logs = explode("\n", $logsContent);

            // Remove any empty log entries
            $logs = array_filter($logs);

            // Process each log entry
            $formattedLogs = [];
            foreach ($logs as $log) {
                // Extract timestamp and message from log entry
                preg_match('/\[(.*?)\].*?local.INFO: (.*)/', $log, $matches);
                if (count($matches) === 3) {
                    $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $matches[1]);
                    $formattedTimestamp = $timestamp->isoFormat('DD MMMM YYYY HH:mm');

                    $formattedLogs[] = [
                        'time' => $formattedTimestamp,
                        'message' => $matches[2]
                    ];
                }
            }

            // Reverse the array to display the latest logs first
            $formattedLogs = array_reverse($formattedLogs);
        } else {
            // Log file does not exist, set logs to empty array
            $formattedLogs = [];
        }

        // Get the user by ID
        $user = User::findOrFail($id);

        return view('mahasiswa.index', [
            'title' => 'Dashboard Mahasiswa',
            'user' => $user,
            'logs' => $formattedLogs
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
