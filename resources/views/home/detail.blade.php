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
                                <a href="#"><img src="{{ asset('storage/' . $bidang->photo) }}" alt="" style="width: 1296px; height: auto;"></a>
                            </div>
                            <div class="down-content">
                                @foreach($skill as $s)
                                <span style="display: inline-block; padding: 5px 10px; background-color: #343a40; color: #fff; border-radius: 10px; margin-right: 10px; margin-bottom: 5px;">{{ $s->nama }}</span>
                                @endforeach
                                <a href="#" style="display: block; margin-top: 10px; margin-bottom: 10px;">
                                    <hr style="border-top: 3px solid #000;">
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