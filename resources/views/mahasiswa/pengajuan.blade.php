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
                                        <p class="mb-0 mr-4 mt-4 text-right" style="font-weight: bold;">{{ $user->nama }}</p>
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
                                                    <form method="POST" id="signup-form" class="signup-form" enctype="multipart/form-data" action="/wikwik">
                                                        <h3>
                                                            Data Umum
                                                        </h3>
                                                        <fieldset>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="date">Nama Lengkap:</label>
                                                                    <input type="text" name="name" id="name" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="date">Tanggal Mulai PKL:</label>
                                                                    <input type="date" name="name" id="name" />
                                                                </div>
                                                                <div class="form-select">
                                                                    <label for="date">Pilih Bidang Kerja</label>
                                                                    <div class="select-group">
                                                                        <select name="daily_budget" id="daily_budget">
                                                                            <option value="" disabled selected hidden></option>
                                                                            <option value="40$">40$</option>
                                                                            <option value="60$">60$</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="date">Tanggal Selesai PKL:</label>
                                                                    <input type="date" name="bidang" id="bidang" />
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <h3>
                                                            Project Sebelumnya
                                                        </h3>
                                                        <fieldset>

                                                        </fieldset>

                                                        <h3>
                                                            Upload Berkas
                                                        </h3>
                                                        <fieldset>

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
                                            <button id="addDataButton" class="btn btn-primary float-right mb-3">Tambah Data</button>
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
                                                    <tr>
                                                        <td class="text-center">John Doe</td>
                                                        <td class="text-center">123456</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-primary">Edit</button>
                                                            <button class="btn btn-sm btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <!-- Tambahkan baris lain sesuai dengan data yang ada -->
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