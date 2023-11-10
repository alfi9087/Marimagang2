<?php

namespace App\Http\Controllers;

use App\Models\SkillUser;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'namaproyek' => 'required|string|max:50',
                'deskripsi' => 'required|string',
                'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'end_date' => 'required|date|after:start_date',
                'proposal' => 'required|mimes:pdf|max:2048',
                'pengantar' => 'required|mimes:pdf|max:2048',
                'bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);

            // Handle file uploads
            $proposalPath = $request->file('proposal')->store('proposal', 'public');
            $pengantarPath = $request->file('pengantar')->store('pengantar', 'public');
            $buktiPath = $request->file('bukti')->store('bukti', 'public');

            // Create a new Pengajuan instance
            $pengajuan = new Pengajuan();
            $pengajuan->user_id = $request->input('user_id');
            $pengajuan->namaproyek = $request->input('namaproyek');
            $pengajuan->deskripsi = $request->input('deskripsi');
            $pengajuan->bukti = $buktiPath;
            $pengajuan->pengantar = $pengantarPath;
            $pengajuan->proposal = $proposalPath;
            $pengajuan->tanggalmulai = $request->input('start_date');
            $pengajuan->tanggalselesai = $request->input('end_date');
            $pengajuan->status = 'Diproses';

            // Save the Pengajuan data
            $pengajuan->save();

            // Attach skills to the user
            $skills = $request->input('skill');
            if (!empty($skills)) {
                foreach ($skills as $skill) {
                    SkillUser::create([
                        'user_id' => $pengajuan->user_id,
                        'skill_id' => $skill,
                    ]);
                }
            }
            // Alert
            Alert::success('Sukses', 'Data Pengajuan Berhasil Dikirim')->showConfirmButton();
            // Display a success message using Sweet Alert
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }
}
