@extends('home.layouts.maindetail')

@section('content')
<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6>Detail</h6>
                <h2>Bidang Sekretariat</h2>
            </div>
        </div>
    </div>
</section>

<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="meeting-single-item">
                            <div class="thumb">
                                <a href="#"><img src="{{ asset('storage/' . $bidang->photo) }}" alt="" style="width: 1115px; height: auto;"></a>
                            </div>
                            <div class="down-content">
                                <a href="#" style="display: block; margin-bottom: 10px;">
                                    <h4>{{ $bidang->nama }}</h4>
                                </a>
                                <p>{!! $bidang->deskripsi !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="main-button-red">
                            <a href="/">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Copyright © 2023 <br> Dinas Komunikasi dan Informatika Kabupaten Malang</p>
    </div>
</section>
@endsection