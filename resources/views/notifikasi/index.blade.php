@extends('notifikasi.layouts.main')

@section('content')
<nav class="navbar navbar-transparent navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="/forms">
                        <i class="fa fa-user"></i>
                        Login / Register
                    </a>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<div class="main" style="background-image: url('assets/images/bg-malang.jpg')">

    <!--    Change the image source '/images/default.jpg' with your favourite image.     -->

    <div class="cover black" data-color="black"></div>

    <!--   You can change the black color for the filter with those colors: blue, green, red, orange       -->
    <div class="container">
        <h1 class="logo">
            <span class="spinner">
                <i class="fa fa-clock-o fa-spin"></i>
            </span>
        </h1>
        <!--  H1 can have 2 designs: "logo" and "logo cursive"           -->
        <div class="content">
            <h4 class="motto">Tunggu sampai admin memverifikasi akun anda</h4>
        </div>
    </div>
</div>
@endsection