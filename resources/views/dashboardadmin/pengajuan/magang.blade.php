@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Magang</h4>
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
                        <a href="#">Data Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Magang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Magang</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status Pengajuan</th>
                                            <th>Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status Pengajuan</th>
                                            <th>Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($pengajuan as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->tanggalmulai }}</td>
                                            <td>{{ $p->tanggalselesai }}</td>
                                            <td><span class="badge badge-light">{{ $p->status }}</span></td>
                                            <td>
                                                <a href="/userdetailadmin/{{ $p->id }}">
                                                    <button type="button" class="btn btn-sm btn-info">
                                                        <i class="fas fa-user-alt"></i> Profil
                                                    </button>
                                                </a>
                                            </td>
                                            if
                                            <td>
                                                @if ($p->status === 'Magang')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-danger mr-1" data-toggle="modal" data-target="#selesai{{ $p->id }}">
                                                        Selesaikan
                                                    </button>

                                                    <!-- Modal Selesai Magang -->
                                                    <div class="modal fade" id="selesai{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Magang Mahasiswa</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="/selesai" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method("put")
                                                                    <div class="modal-body">
                                                                        <p style="font-size: 18px;">Apakah Anda yakin untuk menyelesaikan magang <br> <strong>{{ $p->user->nama }}</strong> di <strong>{{ $p->databidang->nama }}</strong>?</p>
                                                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                                                        <div class="form-group">
                                                                            <label for="suratmagang">Upload Surat Selesai Magang (PDF)</label>
                                                                            <input type="file" class="form-control" id="suratmagang" name="suratmagang" accept=".pdf">
                                                                        </div>
                                                                        <br>
                                                                        <p style="font-size: 18px;"><strong>Note :</strong> Pastikan Laporan Akhir Sudah Diupload</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-success">Ya, Selesaikan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                --
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection