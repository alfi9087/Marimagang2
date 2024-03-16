<?php

namespace App\Http\Controllers;

use App\Models\SkillUser;
use App\Models\Pengajuan;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'end_date' => 'required|date|after:start_date',
                'databidang_id' => 'required|exists:databidang,id',
                'skill' => 'required|array',
                'bukti' => 'required|mimes:pdf|max:2048',
                'pengantar' => 'required|mimes:pdf|max:2048',
                'proposal' => 'required|mimes:pdf|max:2048',
            ]);

            $user_id = $request->input('user_id');

            $skills = $request->input('skill');

            if (!empty($skills)) {
                $pengajuan = Pengajuan::create([
                    'user_id' => auth()->id(),
                    'databidang_id' => $request->databidang_id,
                    'tanggalmulai' => $request->input('start_date'),
                    'tanggalselesai' => $request->input('end_date'),
                    'deskripsi' => $request->input('deskripsi'),
                    'status' => 'Diproses',
                    'bukti' => $request->file('bukti')->store('bukti', 'public'),
                    'pengantar' => $request->file('pengantar')->store('pengantar', 'public'),
                    'proposal' => $request->file('proposal')->store('proposal', 'public'),
                ]);

                session(['pengajuan_id' => $pengajuan->id]);

                foreach ($skills as $skill) {
                    SkillUser::create([
                        'user_id' => $user_id,
                        'skill_id' => $skill,
                        'pengajuan_id' => $pengajuan->id
                    ]);
                }
            }

            Alert::success('Sukses', 'Data Pengajuan Berhasil Dikirim')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function updatebidang(Request $request, $id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->databidang_id = $request->input('databidang');

            if ($request->has('skill')) {
                $request->validate([
                    'skill' => 'array',
                ]);

                $pengajuan->skilluser()->delete();

                $skills = $request->input('skill', []);
                foreach ($skills as $skill) {
                    SkillUser::create([
                        'user_id' => $pengajuan->user_id,
                        'skill_id' => $skill,
                        'pengajuan_id' => $pengajuan->id
                    ]);
                }
            }

            $pengajuan->status = 'Diteruskan';
            $pengajuan->save();

            Alert::success('Sukses', 'Data Skill Pengajuan Berhasil Dikirim')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function ditolakadmin(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Ditolak',
                'komentar' => $request->input('komentar'),
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Ditolak')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function ditolakbidang(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Diproses',
                'komentar' => $request->input('komentar'),
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Ditolak')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function diterimabidang(Request $request, $id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Diterima',
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Diterima')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function diterimaadmin(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
                'kesediaan' => 'required|mimes:pdf|max:2048'
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->suratmagang) {
                Storage::disk('public')->delete($pengajuan->suratmagang);
            }

            $kesediaan = $request->file('kesediaan')->store('kesediaan', 'public');

            $pengajuan->update([
                'status' => 'Magang',
                'komentar' => $request->input('komentar'),
                'kesediaan' => $kesediaan
            ]);

            Alert::success('Sukses', 'Data Pengajuan Berhasil Diterima')->showConfirmButton();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
        }

        return redirect()->back();
    }

    public function kesbangpol(Request $request)
    {
        try {
            $request->validate([
                'kesbangpol' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->kesbangpol) {
                Storage::disk('public')->delete($pengajuan->kesbangpol);
            }

            $kesbangpolFile = $request->file('kesbangpol')->store('kesbangpol', 'public');

            $pengajuan->update(['kesbangpol' => $kesbangpolFile]);

            Alert::success('Sukses', 'Data Kesbangpol Berhasil Dikirim')->showConfirmButton();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
        }

        return redirect()->back();
    }

    public function laporan(Request $request)
    {
        try {
            $request->validate([
                'laporan' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
                'dokumentasi' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->laporan) {
                Storage::disk('public')->delete($pengajuan->laporan);
            }

            if ($pengajuan->dokumentasi) {
                Storage::disk('public')->delete($pengajuan->dokumentasi);
            }

            $laporan = $request->file('laporan')->store('laporan', 'public');
            $dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');

            $pengajuan->update([
                'laporan' => $laporan,
                'dokumentasi' => $dokumentasi
            ]);

            Alert::success('Sukses', 'Data Laporan Akhir Berhasil Dikirim')->showConfirmButton();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
        }

        return redirect()->back();
    }

    public function tambahanggota(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'nim' => 'required|numeric|regex:/^[0-9]{1,10}$/',
            ]);

            $user_id = auth()->user()->id;

            $pengajuan_id = $request->input('id_pengajuan');

            Anggota::create([
                'user_id' => $user_id,
                'pengajuan_id' => $pengajuan_id,
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

            $anggota = Anggota::findOrFail($id);

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
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();

            Alert::success('Berhasil', 'Anggota berhasil dihapus');

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function selesai(Request $request)
    {
        try {
            $request->validate([
                'suratmagang' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            $suratmagang = $request->file('suratmagang')->store('suratmagang', 'public');

            $pengajuan->update([
                'suratmagang' => $suratmagang,
                'status' => 'Selesai'
            ]);

            Alert::success('Sukses', 'Magang Telah Diselesaikan')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }

    public function logbook(Request $request, $id)
    {
        try {
            $request->validate([
                'kegiatan' => 'required',
                'tanggal' => 'required|date',
            ]);

            $user = User::findOrFail($id);
            $user_id = $user->id;
            $pengajuan_id = $request->input('id_pengajuan');

            $tanggal = Carbon::parse($request->tanggal);

            Logbook::create([
                'user_id' => $user_id,
                'pengajuan_id' => $pengajuan_id,
                'tanggal' => $tanggal,
                'kegiatan' => $request->kegiatan,
            ]);

            Alert::success('Sukses', 'Logbook Berhasil Ditambahkan')->showConfirmButton();

            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back();
        }
    }
}
