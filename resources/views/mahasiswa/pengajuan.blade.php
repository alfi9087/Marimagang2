@extends('mahasiswa.layouts.mainupload')

@section('content')
<div class="container-fluid px-0" id="bg-div">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">
            <div class="card card0">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="bg-light border-right" id="sidebar-wrapper">
                        <div class="sidebar-heading pt-5 pb-4">
                            <strong>MENU</strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item active1">
                                <div class="list-div my-2">
                                    <div class="fa fa-home"></div> &nbsp;&nbsp; Pengajuan PKL
                                </div>
                            </a>
                            <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item bg-light">
                                <div class="list-div my-2">
                                    <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Lihat Data Anggota
                                </div>
                            </a>
                            <a data-toggle="tab" href="#menu3" id="tab3" class="tabs list-group-item bg-light">
                                <div class="list-div my-2">
                                    <div class="fa fa-qrcode"></div> &nbsp;&nbsp;&nbsp; Riwayat Pengajuan
                                </div>
                            </a>
                        </div>
                    </div> <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="row pt-3" id="border-btm">
                            <div class="col-4">
                                <button class="btn btn-danger mt-4 ml-3 mb-3" id="menu-toggle">
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                </button>
                            </div>
                            <div class="col-8">
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 mt-4 text-right" style="font-weight: bold;">
                                            {{ $user->nama }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 text-right">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                        </div>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane in active">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h4 class="mt-0 mb-4 text-center">FORM PENGAJUAN PKL</h4>
                                            <div class="main">

                                                <div class="container">
                                                    <form method="POST" id="pengajuan-form" class="pengajuan-form" enctype="multipart/form-data" action="{{ route('pengajuan.submit') }}">
                                                        @csrf
                                                        <h3>
                                                            Data Umum
                                                        </h3>
                                                        <fieldset>
                                                            <div class="form-group" style="width: 100%;">
                                                                <label for="name">Nama Lengkap:</label>
                                                                <input type="text" name="display_name" id="display_name" value="{{ $user->nama }}" disabled />
                                                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="start_date">Tanggal Mulai Magang:</label>
                                                                    <input type="date" name="start_date" id="start_date" min="{{ date('Y-m-d') }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_date">Tanggal Selesai Magang:</label>
                                                                    <input type="date" name="end_date" id="end_date" min="{{ date('Y-m-d') }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-select">
                                                                    <label for="databidang">Pilih Bidang Kerja</label>
                                                                    <div class="select-group">
                                                                        <select name="databidang" id="databidang">
                                                                            <option value="" disabled selected hidden></option>
                                                                            @foreach ($databidang as $bidang)
                                                                            <option value="{{ $bidang->id }}">
                                                                                {{ $bidang->nama }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-select">
                                                                    <label for="skill">Pilih Skill</label>
                                                                    <div class="select-group">
                                                                        <select name="skill[]" id="skill" multiple="multiple">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <h3>
                                                            Project Sebelumnya
                                                        </h3>
                                                        <fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="namaproyek">Nama Project:</label>
                                                                    <input type="text" name="namaproyek" id="namaproyek" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="bukti">Bukti Project (pdf):</label>
                                                                    <input type="file" name="bukti" id="bukti" />
                                                                </div>
                                                            </div>
                                                            <div class="form">
                                                                <label for="my-editor">Deskripsi Project:</label>
                                                                <textarea class="form-control" id="deskripsi" name="deskripsi" style="resize: none; width: 100%; height:250px;"></textarea>
                                                            </div>
                                                        </fieldset>

                                                        <h3>
                                                            Upload Berkas
                                                        </h3>
                                                        <fieldset>
                                                            <div class="container mt-5">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="proposal">Proposal
                                                                            Magang:</label>
                                                                        <div class="upload-box" id="left-box">
                                                                            <p>Drag & Drop PDF</p>
                                                                            <br>
                                                                            <button type="button" class="btn btn-danger">Pilih
                                                                                File</button>
                                                                            <input type="file" id="proposal" name="proposal" accept=".pdf" style="display: none;">
                                                                        </div>
                                                                        <div id="proposal-info"></div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="pengantar">Surat Pengantar
                                                                            Pendidikan:</label>
                                                                        <div class="upload-box" id="right-box">
                                                                            <p>Drag & Drop PDF</p>
                                                                            <br>
                                                                            <button type="button" class="btn btn-danger">Pilih
                                                                                File</button>
                                                                            <input type="file" id="pengantar" name="pengantar" accept=".pdf" style="display: none;">
                                                                        </div>
                                                                        <div id="pengantar-info"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h4 class="mt-0 mb-4 text-center">DATA ANGGOTA PKL</h4>
                                            <button type="button" class="btn btn-danger float-right mb-3" data-toggle="modal" data-target="#add">
                                                + Tambah Data
                                            </button>
                                            <!-- Modal Tambah Anggota -->
                                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tambah
                                                                Anggota</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ route('tambah.anggota') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="form-group">
                                                                        <label for="previous_name">Nama:</label>
                                                                        <input type="text" name="nama" id="nama" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="previous_image">NIM:</label>
                                                                        <input type="text" name="nim" id="nim" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">NIM</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Isi tabel di sini -->
                                                    @foreach ($user->anggota as $anggota)
                                                    <tr>
                                                        <td class="text-center">{{ $anggota->nama }}</td>
                                                        <td class="text-center">{{ $anggota->nim }}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-{{ $anggota->id }}">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{ $anggota->id }}">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Edit Anggota -->
                                                    <div class="modal fade" id="edit-{{ $anggota->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('edit.anggota', ['id' => $anggota->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-row">
                                                                            <div class="form-group">
                                                                                <label for="nama">Nama:</label>
                                                                                <input type="text" name="nama" id="nama" value="{{ $anggota->nama }}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="nim">NIM:</label>
                                                                                <input type="text" name="nim" id="nim" value="{{ $anggota->nim }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Delete -->
                                                    <div class="modal fade" id="delete-{{ $anggota->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda Yakin Ingin Menghapus Data Ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('delete.anggota', ['id' => $anggota->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </form>
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

                            <div id="menu3" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <h4 class="mt-0 mb-4 text-center">RIWAYAT PENGAJUAN PKL</h4>
                                        <div class="row justify-content-center">
                                            <div class="scrolling-container">
                                                @foreach ($pengajuan as $p)
                                                <!-- Contoh beberapa kartu (cards) -->
                                                <div class="card mb-3" style="width: 600px;"> <!-- Ganti 200px sesuai kebutuhan Anda -->
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        Permohonan Magang
                                                        <!-- Tambahkan tulisan status di sini -->
                                                        <span class="badge badge-success">{{ $p->status }}</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <blockquote class="blockquote mb-0">
                                                            <p>Tanggal Mulai : {{ $p->tanggalmulai }}</p>
                                                            <p>Tanggal Selesai : {{ $p->tanggalselesai }}</p>
                                                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                                <!-- Tambahkan lebih banyak kartu sesuai kebutuhan -->
                                                @endforeach
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
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Select2 for#databidang
        $('#databidang').select2({
            width: '100%',
        });
        $('#skill').select2({
            width: '100%',
        });

        // Event listener for changing the#databidang
        $('#databidang').on('change', function() {
            $('#skill').empty(); // Kosongkan pilihan keterampilan saat bidang berubah
            var databidang_id = $(this)
                .val(); // Ambil nilai databidang_id dari select bidang yang berubah
            $.get("{{ url('pengajuan/pilihan-skill') }}/" + databidang_id, function(data, status) {


                $("#skill").select2({
                    data: data.results,
                    width: '100%',
                })
            });
        });
    });
</script>
@endpush