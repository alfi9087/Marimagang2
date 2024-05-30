<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8">
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="right-icons">
                    <ul>
                        <li><a href="https://facebook.com/kominfokabmalang"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/kominfokabmlg"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/kominfokabmlg/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://youtube.com/channel/UCPo6b6DOnJvve7ORpDUbkXA"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <nav class="main-nav">

                    <a href="/mahasiswa/{{ $user->id }}" class="logo">
                        Mari Magang
                    </a>


                    <ul class="nav">
                        <li><a href="/mahasiswa/{{ $user->id }}">Beranda</a></li>
                        <li>
                            <a href="/alurmagang/{{ $user->id }}">Alur Magang</a>
                        </li>
                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                        @else
                        <li>
                            <a href="/pengajuan/{{ $user->id }}">Pengajuan Magang</a>
                        </li>
                        @endif
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>

                </nav>

            </div>
        </div>
    </div>
</header>