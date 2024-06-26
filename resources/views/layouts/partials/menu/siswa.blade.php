<li class="nav-item">
    <a href="{{ route('siswa/dashboard') }}"
        class="nav-link {{ Route::currentRouteName() == 'siswa/dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('siswa/jadwal-bimbingan') }}"
        class="nav-link {{ Route::currentRouteName() == 'siswa/jadwal-bimbingan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar"></i>
        <p>
            Jadwal Bimbingan
        </p>
    </a>
</li>

<li class="nav-item ">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-mail-bulk">@if($pesan > 0)
            <span class="badge">{{ $pesan }}</span>
            @endif</i>
        <p>
            Pesan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('siswa/pesan-masuk')}}" class="nav-link {{ Route::currentRouteName() == 'siswa/pesan-masuk' ? 'active' : '' }}">
                <i class="fas fa-inbox nav-icon">@if($pesan > 0)
            <span class="badge">{{ $pesan }}</span>
            @endif</i>
                <p>Masuk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('siswa/pesan-keluar') }}"
                class="nav-link {{ Route::currentRouteName() == 'siswa/pesan-keluar' ? 'active' : '' }}">
                <i class="fab fa-telegram-plane nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</li>