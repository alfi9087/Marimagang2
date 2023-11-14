@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pengajuan Magang</h4>
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
                        <a href="#">Permohonan Magang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Data Pengajuan Magang</h4>
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
                                            <th>Action</th> <!-- New column for actions -->
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
                                            <td>
                                                @if($p->status == 'Diproses')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#diteruskanModal{{ $p->id }}">
                                                            Diteruskan Ke Bidang
                                                        </button>
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#ditolak{{ $p->id }}">
                                                            Ditolak
                                                        </button>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Modal Diteruskan Ke Bidang -->
                                        <div class="modal fade" id="diteruskanModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Bidang Yang Direkomendasikan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="bidangRekomendasi">Bidang Rekomendasi:</label>
                                                                <select class="form-control" id="bidangRekomendasi" name="bidangRekomendasi" required>
                                                                    <option value="bidang1">Bidang 1</option>
                                                                    <option value="bidang2">Bidang 2</option>
                                                                    <option value="bidang3">Bidang 3</option>
                                                                    <!-- Add more options as needed -->
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-success">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Ditolak Modal -->
                                        <div class="modal fade" id="ditolak{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Pengajuan Magang Ditolak</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="komentar">Komentar:</label>
                                                                <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-success">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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