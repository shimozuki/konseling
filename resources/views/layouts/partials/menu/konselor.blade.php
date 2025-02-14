<style>
    .nav-link {
        position: relative;
        padding-left: -30px;
        /* Tambahkan padding di sebelah kanan untuk ruang badge */
    }

    .nav-link .badge {
        background-color: red;
        border-radius: 50%;
        color: white;
        padding: 5px 10px;
        font-size: 12px;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
    }
</style>

<li class="nav-item">
    <a href="{{ route('konselor/dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'konselor/dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('konselor/jadwal-bimbingan') }}" class="nav-link {{ Route::currentRouteName() == 'konselor/jadwal-bimbingan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar"> @if($jumlahJadwal > 0)
            <span class="badge">{{ $jumlahJadwal }}</span>
            @endif</i>
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
            <a href="{{ route('konselor/pesan-masuk') }}" class="nav-link {{ Route::currentRouteName() == 'konselor/pesan-masuk' ? 'active' : '' }}">
                <i class="fas fa-inbox nav-icon">@if($pesan > 0)
            <span class="badge">{{ $pesan }}</span>
            @endif</i>
                <p>Masuk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('konselor/pesan-keluar') }}" class="nav-link {{ Route::currentRouteName() == 'konselor/pesan-keluar' ? 'active' : '' }}">
                <i class="fab fa-telegram-plane nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</li>