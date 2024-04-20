<style>
    .nav-item {
        border-bottom: 1px solid #ccc; /* Garis pembatas */
    }

    /* Menambahkan garis pembatas kecuali untuk menu pertama (Dashboard) */
    .nav-item:not(:first-child) {
        margin-top: 10px; /* Jarak antara menu */
    }

    .judul{
        color: #d79447;
    }
</style>

<ul class="nav">
    <img src="{{asset('img/logo2.png')}}" alt="" style="max-width: 65px; max-height: 65px; display: block; margin: auto; margin-top: 13px; margin-bottom: 15px;" />
    <h4 class="judul text-center">Pantau Tamu Pro</h4><br>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="ti-shield menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('element') }}">
            <i class="ti-layout-list-post menu-icon"></i>
            <span class="menu-title">Rekapitulasi Tamu</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('vip.index') }}">
            <i class="ti-view-list-alt menu-icon"></i>
            <span class="menu-title">Rekapitulasi VIP</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.index') }}">
            <i class="ti-view-list-alt menu-icon"></i>
            <span class="menu-title">Manajemen Akun</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.index') }}">
            <i class="ti-view-list-alt menu-icon"></i>
            <span class="menu-title">Manajemen Karyawan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.index') }}">
            <i class="ti-agenda menu-icon"></i>
            <span class="menu-title">Survey Kepuasan Pengguna</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.index') }}">
            <i class="ti-agenda menu-icon"></i>
            <span class="menu-title">Manajemen Survey</span>
        </a>
    </li>
    
    <!-- Tambahkan menu Data Feedback di sini -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('feedback.index') }}">
            <i class="ti-comments menu-icon"></i>
            <span class="menu-title">Data Feedback</span>
        </a>
    </li>
</ul>
