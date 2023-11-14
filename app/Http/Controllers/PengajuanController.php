<?php

namespace App\Http\Controllers;

use App\Models\SkillUser;
use App\Models\Pengajuan;
use App\Models\Anggota;
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
                'bukti' => 'required|mimes:pdf|max:2048',
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

    public function tambahanggota(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'nim' => 'required|numeric|regex:/^[0-9]{1,10}$/|unique:anggota,nim',
            ]);

            // Ambil user_id dari user saat ini
            $user_id = auth()->user()->id;

            // Simpan anggota
            Anggota::create([
                'user_id' => $user_id,
                'nama' => $request->input('nama'),
                'nim' => $request->input('nim'),
            ]);

            Alert::success('Berhasil', 'Anggota berhasil ditambahkan');

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function editanggota(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'nim' => 'required|numeric|regex:/^[0-9]{1,10}$/|unique:anggota,nim,' . $id,
            ]);

            // Ambil anggota berdasarkan ID
            $anggota = Anggota::findOrFail($id);

            // Update data anggota
            $anggota->update([
                'nama' => $request->input('nama'),
                'nim' => $request->input('nim'),
            ]);

            Alert::success('Berhasil', 'Anggota berhasil diupdate');

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function deleteanggota($id)
    {
        try {
            // Hapus anggota berdasarkan ID
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();

            Alert::success('Berhasil', 'Anggota berhasil dihapus');

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }
}
