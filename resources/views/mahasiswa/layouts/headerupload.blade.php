<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <a href="/" class="logo">
                        Mari Magang
                    </a>


                    <ul class="nav">
                        <li><a href="/mahasiswa/{{ $user->id }}">Beranda</a></li>
                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                        @else
                        <li>
                            <a href="/pengajuan/{{ $user->id }}">Pengajuan PKL</a>
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