@extends('dashboard.mahasiswa.layouts.main')

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
                        <a href="#">Data Akun</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Mahasiswa</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail Mahasiswa</a>
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
                                @if(!$user->foto)
                                <img class="media-object mw150 rounded-circle shadow" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" style="width: 150px; height: 150px; background-color:white">
                                @else
                                <img class="media-object mw150 rounded-circle shadow" src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" style="width: 150px; height: 150px;">
                                @endif
                            </a>
                        </div>
                        <div class="media-body va-m" style="margin-left: 25px;">
                            @if(!$user->nama)
                            <h2 class="media-heading">Data Belum Ditambahkan</h2>
                            @else
                            <h2 class="media-heading">{{ $user->nama }}</h2>
                            @endif
                            <p class="lead">Lorem ipsum dolor sit amet ctetur adicing elit, sed do eiusmod tempor incididunt</p>
                            <a href="" class="btn btn-primary">Gmail</a> <!-- Tombol Gmail -->
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
                                <span class="panel-title"> My Skills</span>
                            </div>
                            <div class="panel-body pb5">
                                <span class="label label-warning mr5 mb10 ib lh15">Default</span>
                                <span class="label label-primary mr5 mb10 ib lh15">Primary</span>
                                <span class="label label-info mr5 mb10 ib lh15">Success</span>
                                <span class="label label-success mr5 mb10 ib lh15">Info</span>
                                <span class="label label-alert mr5 mb10 ib lh15">Warning</span>
                                <span class="label label-system mr5 mb10 ib lh15">Danger</span>
                                <span class="label label-info mr5 mb10 ib lh15">Success</span>
                                <span class="label label-success mr5 mb10 ib lh15">Ui Design</span>
                                <span class="label label-primary mr5 mb10 ib lh15">Primary</span>

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

                                <h4>Facebook Internship</h4>
                                <p class="text-muted"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 - 2012
                                </p>

                                <hr class="short br-lighter">

                                <h6>Education</h6>

                                <h4>Bachelor of Science, PhD</h4>
                                <p class="text-muted"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 through Aug 2011
                                </p>

                                <hr class="short br-lighter">

                                <h6>Accomplishments</h6>

                                <h4>Successful Business</h4>
                                <p class="text-muted pb10"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 through Aug 2011
                                </p>

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
                                <div id="tab2" class="tab-pane">
                                    
                                </div>
                                <div id="tab3" class="tab-pane"></div>
                                <div id="tab4" class="tab-pane"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection