@extends('mahasiswa.layouts.main')

@section('content')
<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Selamat Datang</h2>
                <h6>Mahasiswa Seluruh Indonesia</h6>
            </div>
        </div>
    </div>
</section>

<section class="steps-section" id="steps">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <h2>LANGKAH LANGKAH PENGAJUAN MAGANG</h2>
                    <div class="step-box">
                        <div class="step" id="step1" @if($login) style="background-color: #DC143C;" @endif>
                            <div class="step-number" @if($login) style="color: white;" @endif>1</div>
                            <div class="step-content">
                                <h3 @if($login) style="color: white;" @endif>REGISTRASI DAN LOGIN</h3>
                                <p @if($login) style="color: white;" @endif>Melakukan Registrasi Akun dan Login Ketika Status Akun Sudah Terverifikasi</p>
                            </div>
                        </div>
                        <div class="step" id="step2" @if($profil) style="background-color: #DC143C;" @endif>
                            <div class="step-number" @if($profil) style="color: white;" @endif>2</div>
                            <div class="step-content">
                                <h3 @if($profil) style="color: white;" @endif>PROFIL MAHASISWA</h3>
                                <p @if($profil) style="color: white;" @endif>Melengkapi Semua Data Profil Yang Dibutuhkan (Termasuk Foto Profil)</p>
                            </div>
                        </div>
                        <div class="step" id="step3" @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="background-color: #DC143C;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>3</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>PENGAJUAN MAGANG</h3>
                                <p @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>Mahasiswa Melakukan Pengajuan Magang Pada Menu Pengajuan Magang Setelah Melengkapi Profil</p>
                            </div>
                        </div>
                        <div class="step" id="step4" @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="background-color: #DC143C;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>4</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>ACC ADMIN 1</h3>
                                <p @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>Pengajuan Akan Diverifikasi Admin dan Meneruskan Ke Bidang Yang Telah Dipilih Mahasiswa</p>
                            </div>
                        </div>
                        <div class="step" id="step5" @if($pengajuanDiterima || $magang || $magangSelesai) style="background-color: #DC143C;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif style="display: none;">
                            <div class="step-number" @if($pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>5</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>ACC BIDANG</h3>
                                <p @if($pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>Setiap Bidang Juga Akan Melakukan Verifikasi Pengajuan Mahasiswa</p>
                            </div>
                        </div>
                        <div class="step" id="step6" @if($magang || $magangSelesai) style="background-color: #DC143C;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif style="display: none;">
                            <div class="step-number" @if($magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>6</div>
                            <div class="step-content">
                                <h3 @if($magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>ACC ADMIN 2</h3>
                                <p @if($magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #DC143C;" @endif>Upload Surat Kesbangpol dan Menunggu Verifikasi Surat Kesbangpol Oleh Admin</p>
                            </div>
                        </div>
                        <div class="step" id="step7" @if($magang || $magangSelesai) style="background-color: #DC143C;" @endif style="display: none;">
                            <div class="step-number" @if($magang || $magangSelesai) style="color: white;" @endif>7</div>
                            <div class="step-content">
                                <h3 @if($magang || $magangSelesai) style="color: white;" @endif>KEGIATAN MAGANG</h3>
                                <p @if($magang || $magangSelesai) style="color: white;" @endif>Anda Dinyatakan Magang dan Jangan Lupa Untuk Mengisi Logbook Serta Upload Berkas Akhir</p>
                            </div>
                        </div>
                        <div class="step" id="step8" @if($magangSelesai) style="background-color: #DC143C;" @endif style="display: none;">
                            <div class="step-number" @if($magangSelesai) style="color: white;" @endif>8</div>
                            <div class="step-content">
                                <h3 @if($magangSelesai) style="color: white;" @endif>MAGANG SELESAI</h3>
                                <p @if($magangSelesai) style="color: white;" @endif>Magang Dinyatakan Selesai Oleh Admin Setelah Semua Dokumen Akhir Lengkap</p>
                            </div>
                        </div>
                        <div class="step-nav step-nav-right">
                            <button onclick="showNextSteps()"><i class="fa-regular fa-hand-point-right"></i></button>
                        </div>
                        <div class="step-nav step-nav-left">
                            <button onclick="showPreviousSteps()"><i class="fa-regular fa-hand-point-left"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <section style="background-color: #eee;">
                        <div class="container py-4">

                            <div class="row">

                                <div class="col-lg-4">

                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            @if(!$user->foto)
                                            <img src="https://i.pinimg.com/236x/83/52/64/835264761a076845234005154f1bacd8.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                            @else
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="foto profil" class="rounded-circle img-fluid" style="width: 175px; height: 175px;">
                                            @endif
                                            <h5 class="my-3">
                                                @if(!$user->nama)
                                                Nama
                                                @else
                                                {{ $user->nama }}
                                                @endif
                                            </h5>
                                            <p class="text-muted mb-1">{{ $user->nim }}</p>
                                            <p class="text-muted mb-4">
                                                @if(!$user->kampus)
                                                Asal Kampus
                                                @else
                                                {{ $user->kampus }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card mb-6">

                                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                                        <button class="btn" style="width: 100%; background-color: #DC143C; color: white;" data-bs-toggle="modal" data-bs-target="#modalform">Lengkapi Profil</button>
                                        @else
                                        <button class="btn" style="width: 100%; background-color: #DC143C; color: white;" data-bs-toggle="modal" data-bs-target="#modalformedit">Edit Profil</button>
                                        @endif
                                    </div>

                                    <!-- Modal Untuk Menambah Profil Mahasiswa -->
                                    <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lengkapi Profil Anda</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('mahasiswa.submit', ['id' => $user->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img src="https://i.pinimg.com/236x/83/52/64/835264761a076845234005154f1bacd8.jpg" class="rounded-circle" alt="example placeholder" style="width: 200px;" id="add" />
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <div class="btn btn-rounded" style="background-color: #DC143C; color: white;">
                                                                    <label class="form-label text-white m-1" for="customFile2">Pilih Foto Profil</label>

                                                                    <input type="file" class="form-control d-none form-control-user @error('foto') is-invalid @enderror" id="customFile2" name="foto" value="{{ old('foto') }}" onchange="preview(event)">

                                                                    @error('foto')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="col-form-label">Nama Lengkap:</label>
                                                            <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">

                                                            @error('nama')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kampus" class="col-form-label">Asal Kampus:</label>
                                                            <input type="text" class="form-control form-control-user @error('kampus') is-invalid @enderror" id="kampus" name="kampus" value="{{ old('kampus') }}">

                                                            @error('kampus')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jurusan" class="col-form-label">Jurusan:</label>
                                                            <input type="text" class="form-control form-control-user @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}">

                                                            @error('jurusan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="prodi" class="col-form-label">Prodi:</label>
                                                            <input type="text" class="form-control form-control-user @error('prodi') is-invalid @enderror" id="prodi" name="prodi" value="{{ old('prodi') }}">

                                                            @error('prodi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">Nomor Telepon:</label>
                                                            <input type="text" class="form-control form-control-user @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}">

                                                            @error('telepon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn" style="background-color: #DC143C; color: white;">Kirim Data</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Untuk Edit Profil -->
                                    <div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil Anda</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="POST" action="/marimagang/mahasiswaupdate/{{ $user->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')

                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img src="#" class="rounded-circle" alt="Photo Preview" style="display: none; width: 200px; height: 200px;" id="photo-preview" />
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" name="foto" id="foto" style="display: none;">

                                                                @error('foto')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror

                                                                <label class="form-label text-white m-1" for="foto" style="background-color: #DC143C; color: white; padding: 6px 12px; cursor: pointer; border: none;">
                                                                    Ubah Foto Profil
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="col-form-label">Nama Lengkap:</label>
                                                            <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}">

                                                            @error('nama')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">NIM:</label>
                                                            <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $user->nim) }}">

                                                            @error('nim')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kampus" class="col-form-label">Asal Kampus:</label>
                                                            <input type="text" class="form-control form-control-user @error('kampus') is-invalid @enderror" id="kampus" name="kampus" value="{{ old('kampus', $user->kampus) }}">

                                                            @error('kampus')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jurusan" class="col-form-label">Jurusan:</label>
                                                            <input type="text" class="form-control form-control-user @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}">

                                                            @error('jurusan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="prodi" class="col-form-label">Prodi:</label>
                                                            <input type="text" class="form-control form-control-user @error('prodi') is-invalid @enderror" id="prodi" name="prodi" value="{{ old('prodi', $user->prodi) }}">

                                                            @error('prodi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">Nomor Telepon:</label>
                                                            <input type="text" class="form-control form-control-user @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}">

                                                            @error('telepon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn" style="background-color: #DC143C; color: white;">Kirim Data</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Menampilkan Data Mahasiswa -->
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @if(!$user->nama)
                                                    <p class="text-muted mb-0">Data belum ditambahkan</p>
                                                    @else
                                                    <p class="text-muted mb-0">{{ $user->nama }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Asal Kampus</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->kampus)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->kampus }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $user->nim }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Jurusan</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->jurusan)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->jurusan }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Prodi</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->prodi)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->prodi }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nomor Telepon</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->telepon)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->telepon }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center font-weight-bold">LOG AKTIFITAS</h5>
                                            <hr>
                                            @if ($riwayat->isEmpty())
                                            <p class="text-center">Aktivitas Belum Tersedia</p>
                                            @else
                                            <ul class="log-list">
                                                @foreach($riwayat as $r)
                                                <li class="log-item">
                                                    <div class="log-message">{{ $r->pesan }}</div>
                                                    <div class="log-time">{{ $r->created_at->format('d F Y H:i') }}</div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection