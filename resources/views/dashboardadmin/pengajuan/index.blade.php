@extends('dashboardadmin.layouts.main')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengajuan Magang</h4>
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
                        <a href="#">Data Permohonan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pengajuan Magang</a>
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
                                            <th>Bidang</th>
                                            <th>Detail</th>
                                            <th>Status Pengajuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="text-align: center;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Bidang</th>
                                            <th>Detail</th>
                                            <th>Status Pengajuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="text-align: center;">
                                        @foreach ($pengajuan as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>
                                                {{ $p->user->nama }}
                                            </td>
                                            <td>{{ $p->tanggalmulai }}</td>
                                            <td>{{ $p->tanggalselesai }}</td>
                                            @if ($p->databidang != null)
                                            <td>{{ $p->databidang->nama }}</td>
                                            @else
                                            <td>Tidak Ada</td>
                                            @endif
                                            <td>
                                                <a href="/userdetailadmin/{{ $p->id }}">
                                                    <button type="button" class="btn btn-xs btn-info">
                                                        Profil
                                                    </button>
                                                </a>
                                            </td>
                                            <td><span class="badge badge-light">{{ $p->status }}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#diteruskanModal{{ $p->id }}">
                                                            Diteruskan Ke Bidang
                                                        </button>
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#ditolak{{ $p->id }}">
                                                            Ditolak
                                                        </button>
                                                        @if(!empty($p->komentar))
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#lihatKomentarModal{{ $p->id }}">
                                                            Lihat Komentar
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
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
                                                    <form method="POST" action="/diteruskan/{{ $p->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method("put")
                                                        <div class="modal-body">
                                                            <div style="margin-bottom: 15px;">
                                                                <label for="databidang">Pilih Bidang Kerja</label>
                                                                <select name="databidang" id="databidang">
                                                                    <option value="" disabled hidden></option>
                                                                    @foreach ($databidang as $bidang)
                                                                    <option value="{{ $bidang->id }}" {{ $bidang->id == $p->databidang_id ? 'selected' : '' }}>
                                                                        {{ $bidang->nama }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div style="margin-bottom: 15px;">
                                                                <label for="skill">Pilih Skill</label>
                                                                <select name="skill[]" id="skill" multiple="multiple">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Kirim Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ditolak Modal -->
                                        <div class="modal fade" id="ditolak{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Pengajuan Magang Ditolak</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="/ditolakadmin/{{ $p->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method("put")
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Komentar</label>
                                                                <div class="col-sm-9">
                                                                    <textarea id="my-editor" class="my-editor form-control @error('komentar') is-invalid @enderror" name="komentar" id="komentar" placeholder="Komentar">{{ old('komentar') }}</textarea>

                                                                    @error('komentar')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Kirim Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Komentar -->
                                        @if(!empty($p->komentar))
                                        <div class="modal fade" id="lihatKomentarModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Alasan Penolakan Pengajuan Oleh Bidang</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{!! $p->komentar !!}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

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
@push('script')
<script>
    $(document).ready(function() {
        $('#databidang').select2({
            width: '100%',
        });
        $('#skill').select2({
            width: '100%',
        });

        $('#databidang').on('change', function() {
            $('#skill').empty();
            var databidang_id = $(this).val();
            $.get("{{ url('pengajuan/update-skill') }}/" + databidang_id, function(data, status) {
                if (Array.isArray(data.results)) {
                    $("#skill").select2({
                        data: data.results,
                        width: '100%',
                    });
                }
            });
        });

        $("#skill").select2({
            width: '100%',
        });
    });
</script>
@endpush