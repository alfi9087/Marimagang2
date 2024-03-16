@extends('home.layouts.main')

@section('content')
<section class="section main-banner" id="top" data-section="section1">
    <img src="assets/images/diskominfo.png" alt="">

    <div class="video-overlay header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <h6>Hallo Peserta Magang</h6>
                        <h2>Selamat Datang di Mari Magang</h2>
                        <p>Tempat mahasiswa melakukan pendaftaran magang atau PKL di Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                        <div class="main-button-red">
                            <div class="scroll-to-section"><a href="/forms">Gabung Sekarang !</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-service-item owl-carousel">

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/pendaftaran.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <h4>Pendaftaran Mudah</h4>
                            <p>Pendaftaran magang atau pkl di Dinas Komunikasi dan Informatika Kabupaten Malang dengan mudah dan cepat</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/bidang.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <h4>Banyak Bidang Kerja</h4>
                            <p>Tersedia Bidang Komunikasi, Bidang Aplikasi Informatika, Bidang Statistik, Bidang Infrastruktur, dan Sekretariat</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/pendaftaran-online.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <h4>Pendaftaran Online</h4>
                            <p>Mahasiswa dapat dengan mudah melakukan pendaftaran dari mana saja tanpa harus datang ke kantor</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/verifikasi.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <h4>Proses Verifikasi Cepat</h4>
                            <p>Dokumen yang diupload akan cepat diverifikasi oleh admin dan lanjut pada tahap berikutnya</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/keamanan.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <h4>Keamanan Terjamin</h4>
                            <p>Seluruh berkas dokumen magang atau PKL yang diupload oleh mahasiswa akan dijaga kerahasiaannya.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Bidang Kerja Diskominfo Kabupaten Malang</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($databidang as $d)
            <div class="col-lg-4">
                <div class="meeting-item">
                    <div class="thumb">
                        <a href="/homedetail/{{ $d->id }}"><img src="{{ asset('storage/' . $d->thumbnail) }}" alt="New Lecturer Meeting" style="width: 100%; height: 250px;"></a>
                    </div>
                    <div class="down-content">
                        <a href="/homedetail/{{ $d->id }}">
                            <h4 style="margin: 0; padding: 0;">{{ $d->nama }}</h4>
                        </a>
                        <p style="margin: 0; padding: 0;">Bidang Sekretariat Untuk Mahasiswa Magang / PKL</p>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 3 == 0)
        </div>
        <div class="row justify-content-center">
            @endif
            @endforeach
        </div>
    </div>
</section>

<section class="apply-now" id="apply">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="item">
                            <h3>Tanya Jawab Seputar Magang</h3>
                            <p>Pertanyaan umum yang sering ditanyakan oleh para mahasiswa yang ingin mendaftar di Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                            <div class="main-button-red">
                                <div><a href="/forms">Gabung Sekarang!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordions is-first-expanded">
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apa saja persyaratan yang diperlukan untuk magang ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Syarat yang diperlukan untuk magang adalah menyiapkan surat pengantar magang dari kampus dan proposal magang yang ditujukan ke Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apakah magang ini berbayar atau tidak ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Seluruh proses pendaftaran dan selama magang tidak akan dikenakan biaya.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apakah akan ada mentor yang membimbing saat magang berlangsung ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Ya, akan ada mentor yang mengarahkan dan membimbing mahasiswa selama magang berlangsung.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion last-accordion">
                        <div class="accordion-head">
                            <span>Apa proyek yang nanti dikerjakan mahasiswa ketika magang ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Untuk proyek yang akan dikerjakan bergantung pada bidang yang diambil oleh mahasiswa</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-facts" id="data">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Data Statistik Mari Magang</h2>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="count-area-content">
                                    <div class="count-digit">{{ $jumlahpengajuan }}</div>
                                    <div class="count-title">Jumlah Seluruh Pengajuan</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="count-area-content">
                                    <div class="count-digit">{{ $jumlahuser }}</div>
                                    <div class="count-title">Jumlah Seluruh Akun Terdaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="count-area-content new-students">
                                    <div class="count-digit">{{ $jumlahdatabidang }}</div>
                                    <div class="count-title">Jumlah Bidang Kerja</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="count-area-content">
                                    <div class="count-digit">{{ $jumlahmagang }}</div>
                                    <div class="count-title">Jumlah Peserta Magang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="video">
                    <a href="#"><img></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection