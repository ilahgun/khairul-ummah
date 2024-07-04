<nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home')}}">
                <img src="{{ url ('landingpage/images/logo_ryd.png') }}" class="logo img-fluid" alt="Kind Heart Charity">
                <span>
                    Rumah Yatim Khairul Ummah
                    <small>Non-profit Organization</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-linkk {{ Request::is('/') || Request::is('home') ? 'active' : ''}}" href="{{ url('/home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkk {{ Request::is('about') ? 'active' : ''}}" href="{{ url('/about')}}">Tentang Kami</a>
                </li>
                
                    <li class="nav-item">
                        <a class="nav-linkk {{ Request::is('kategori') || Request::is('detail') ? 'active' : ''}}" href="{{ url('/kegiatanld')}}">Kegiatan</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a href="#" class="nav-linkk dropdown-toggle {{ Request::is('data_struktur')|| Request::is('data_anak') ? 'active' : ''}}" 
                    data-bs-toggle="dropdown">Library</a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item {{ Request::is('data_struktur') ? 'active' : ''}}" 
                            href="{{ url('/data_struktur')}}">Data Struktur</a></li>
                            <li><a class="dropdown-item {{ Request::is('data_anak') ? 'active' : ''}}" 
                            href="{{ url('/data_anak') }}">Data Anak</a></li>
                        </ul>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-linkk {{ Request::is('contact') ? 'active' : ''}}" href="{{ url('/contact')}}">Kontak</a>
                    </li> --}}

                    <li class="nav-item ms-3">
                        <a class="nav-linkk custom-btn custom-border-btn  {{ Request::is('Donasi') ? 'active' : ''}}"
                         href="{{ url('/donet')}}">Donasi</a>
                    </li>

                </ul>
            </div>
        </div>
</nav>