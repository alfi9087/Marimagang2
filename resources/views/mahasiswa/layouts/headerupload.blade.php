<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <a href="/marimagang/mahasiswa/{{ $user->id }}" class="logo">
                        Mari Magang
                    </a>


                    <ul class="nav">
                        <li><a href="/marimagang/mahasiswa/{{ $user->id }}">Beranda</a></li>
                        <li>
                            <a href="/marimagang/alurmagang/{{ $user->id }}">Alur Magang</a>
                        </li>
                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                        @else
                        <li>
                            <a href="/marimagang/pengajuan/{{ $user->id }}">Pengajuan Magang</a>
                        </li>
                        @endif
                        <li>
                            <a href="/marimagang/logout">Logout</a>
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