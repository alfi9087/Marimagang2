@extends('dashboardadmin.pengajuan.layouts.main')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Mahasiswa</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Permohonan Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail</a>
                    </li>
                </ul>
            </div>

            <br>

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <section id="content" class="container">
                <!-- Begin .page-heading -->
                <div class="page-heading">
                    <div class="media clearfix">
                        <div class="media-left pr30">
                            <a href="#">
                                @if(!$pengajuan->user->foto)
                                <img class="media-object mw150 rounded-circle shadow" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" style="width: 150px; height: 150px; background-color:white">
                                @else
                                <img class="media-object mw150 rounded-circle shadow" src="{{ asset('storage/' . $pengajuan->user->foto ) }}" alt="Foto Profil" style="width: 150px; height: 150px;">
                                @endif
                            </a>
                        </div>
                        <div class="media-body va-m" style="margin-left: 25px;">
                            <h2 class="media-heading">{{ $pengajuan->user->nama }}</h2>
                            <p class="lead">Durasi Magang : ( {{ $pengajuan->tanggalmulai }} - {{ $pengajuan->tanggalselesai }} )</p>
                            <a href="" class="btn btn-danger">Gmail</a> <!-- Tombol Gmail -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-trophy"></i>
                                </span>
                                <span class="panel-title">Skill</span>
                            </div>
                            <div class="panel-body pb5">
                                @foreach ($pengajuan->user->skilluser as $skilluser)
                                <span class="label label-success mr5 mb10 ib lh15">{{ $skilluser->skill->nama }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <span class="panel-title">Project Sebelumnya</span>
                            </div>
                            <div class="panel-body pb5">
                                <h6>Experience</h6>
                                <h4>{{ $pengajuan->namaproyek }}</h4>
                                <p class="text-muted">{{ $pengajuan->deskripsi }}</p>
                                <hr class="short br-lighter">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank" class="btn btn-info btn-sm btn-block">
                                            Lihat 
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ asset('storage/' . $pengajuan->bukti) }}" download class="btn btn-success btn-sm btn-block">
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">

                        <div class="tab-block">
                            <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab1" data-toggle="tab" onclick="activateTab('tab1')">Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab" onclick="activateTab('tab2')">Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab" onclick="activateTab('tab3')">Pengajuan</a>
                                </li>
                            </ul>
                            <div class="tab-content p30" style="height: 730px;">
                                <div id="tab1" class="tab-pane active">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->nama }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->email }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Asal Kampus</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->kampus }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->nim }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Jurusan</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->jurusan }}
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
                                                        {{ $pengajuan->user->prodi }}
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
                                                        {{ $pengajuan->user->telepon }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane">
                                    @foreach ($pengajuan->user->anggota as $anggota)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $anggota->nama }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $anggota->nim }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="tab3" class="tab-pane">
                                    <!-- Konten untuk tab 3 -->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Pengantar Pendidikan</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->pengantar)
                                                    <a href="{{ asset('storage/' . $pengajuan->pengantar) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->pengantar) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">Belum Ada Pengantar Pendidikan</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Proposal</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->proposal)
                                                    <a href="{{ asset('storage/' . $pengajuan->proposal) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->proposal) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">Belum Ada Proposal</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Surat Kesbangpol</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->kesbangpol)
                                                    <a href="{{ asset('storage/' . $pengajuan->kesbangpol) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->kesbangpol) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">Belum Ada File Kesbangpol</p>
                                                    @endif
                                                </div>
                                            </div>
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

@endsection