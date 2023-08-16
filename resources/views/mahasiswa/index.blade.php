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
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                            @else
                                            <img src="{{ asset($user->foto) }}" alt="foto profil" class="rounded-circle img-fluid" style="width: 150px;">
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
                                                        <!--Avatar-->
                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" class="rounded-circle" alt="example placeholder" style="width: 200px;" id="add" />
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

                                    <div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil Anda</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="POST" action="/mahasiswaupdate/{{ $user->id }}" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf

                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img id="previewImage" src="{{ asset($user->foto) }}" class="rounded-circle" alt="Foto Profil" style="width: 200px;" />
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <div class="btn btn-rounded" style="background-color: #DC143C; color: white;">
                                                                    <label class="form-label text-white m-1" for="customFile2">Pilih Foto Profil</label>

                                                                    <input type="file" class="form-control d-none form-control-user @error('foto') is-invalid @enderror" 
                                                                    id="customFile2" name="foto">

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

                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection