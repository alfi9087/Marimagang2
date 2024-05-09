@extends('dashboardbidang.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5" style="background-color: #F25961;">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard {{ $bidang->nama }}</h2>
                        <h5 class="text-white op-7 mb-2">Mengelola Bidang dan Pengajuan Magang</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="/marimagang/databidang/{{ $bidang->id }}" class="btn btn-white btn-border btn-round mr-2">Kelola Bidang</a>
                        <a href="/marimagang/pengajuanbidang/{{ $bidang->id }}" class="btn btn-light btn-round">Kelola Permohonan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Statistik Total Magang</div>
                            <div class="card-category">Menampilkan data total magang dan selesai pada setiap bidang</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                            </div>
                                            <div class="h1 m-0">{{ $sekretariat }}</div>
                                            <div class="text-muted mb-3">Bidang Sekretariat</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                            </div>
                                            <div class="h1 m-0">{{ $aptika }}</div>
                                            <div class="text-muted mb-3">Bidang <br> Aptika</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                            </div>
                                            <div class="h1 m-0">{{ $statistik }}</div>
                                            <div class="text-muted mb-3">Bidang <br> Statistik</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                            </div>
                                            <div class="h1 m-0">{{ $infrastruktur }}</div>
                                            <div class="text-muted mb-3">Bidang Infrastruktur</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-2">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                            </div>
                                            <div class="h1 m-0">{{ $komunikasi }}</div>
                                            <div class="text-muted mb-3">Bidang Komunikasi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection