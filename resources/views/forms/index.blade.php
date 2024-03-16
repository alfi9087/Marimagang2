@extends('forms.layouts.main')

@section('content')
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" id="register-form">
            @csrf
            <h1>Daftar</h1>

            <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}">
            @error('nim')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <br>
            <button type="submit">Daftar</button>
        </form>
    </div>

    <div class="form-container sign-in-container">

        @if (session()->has('success'))
        <div class="card">
            <a class="close-btn" href="/forms">
                &#10006;
            </a>
            <div class="hoverable-div">
                <i class="checkmark">✓</i>
            </div>
            <h1>Success</h1>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" id="login-form" class="signup-form" enctype="multipart/form-data">
            @csrf

            <h1>Masuk</h1>

            @if (session()->has('loginError'))
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('loginError') }}
            </div>
            @endif

            <input type="email" class="form-control form-control-user @error('emaillogin') is-invalid @enderror" id="emaillogin" name="emaillogin" placeholder="Email" value="{{ old('emaillogin') }}">
            @error('emaillogin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <input type="password" class="form-control form-control-user @error('passwordlogin') is-invalid @enderror" id="passwordlogin" name="passwordlogin" placeholder="Password">
            @error('passwordlogin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <br>
            <button type="submit">Masuk</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Silahkan Login</h1>
                <p>Klik tombol dibawah ini untuk masuk pada website </p>
                <button class="ghost" id="signIn">Masuk</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Silahkan Register</h1>
                <p>Klik tombol dibawah ini untuk melakukan pembuatan akun anda</p>
                <button class="ghost" id="signUp">Daftar</button>
            </div>
        </div>
    </div>
</div>
@endsection