@extends('dashboard.layouts.main')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kelola Konten</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/dashboard">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Kelola Konten</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Landing Page</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Kelola Bidang</h4>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#add">
                                    <button class="btn btn-primary">
                                        <span class="btn-label">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        Tambah Bidang
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Bidang</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{ route('home.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Bidang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama Bidang" value="{{ old('nama') }}" />

                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Thumbnail</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail" />

                                        @error('thumbnail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <!-- Preview Thumbnail -->
                                        <img id="thumbnail-preview" src="#" alt="Thumbnail Preview" style="display: none; max-width: 200px; max-height: 200px;" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" name="photo" id="photo" />

                                        @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <!-- Preview Photo -->
                                        <img id="photo-preview" src="#" alt="Photo Preview" style="display: none; max-width: 200px; max-height: 200px;" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <textarea id="my-editor" class="my-editor form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>

                                        @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Skill</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('skill') is-invalid @enderror" name="skill[]" id="skill" placeholder="Skill Yang Dibutuhkan" value="{{ is_array(old('skill')) ? old('skill')[0] : old('skill') }}" />

                                        @error('skill')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <a href="#" class="addmulti btn btn-primary plus float-right">+</a>
                                    </div>
                                </div>

                                <div class="multi">

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    @if(count($bidang) > 0)
                    @foreach ($bidang as $b)
                    <div class="col-md-4">
                        <div class="card card-post card-round" style="border-radius: 10px;">
                            <img class="card-img-top" src="{{ asset('storage/' . $b->thumbnail) }}" alt="Card image cap" style="width: 350px; height: 250px;">
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <h3 class="card-title">
                                    <a href="#">
                                        {{ $b->nama }}
                                    </a>
                                </h3>
                                <p class="card-text">Bidang Sekretariat Untuk Mahasiswa Magang / PKL</p>
                                <a href="/detail/{{ $b->id }}" class="btn btn-primary btn-rounded btn-sm" style="float: right;">Detail</a>
                                <form action="{{ route('bidang.delete', $b->id) }}" method="POST" class="bidang-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-rounded btn-sm" style="float: right; margin-right: 10px;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else
                    <div class="col-md-12" style="display: flex; justify-content: center; align-items: center;">
                        <p>Data Bidang Belum Ditambahkan</p>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection