<ul class="nav">
    <img src="{{asset('img/logo2.png')}}" alt="" style="max-width: 65px; max-height: 65px; display: block; margin: auto; margin-top: 13px; margin-bottom: 15px;" />
    
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
    
    <!-- Tambahkan menu Data Feedback di sini -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('feedback.index') }}">
            <i class="ti-comments menu-icon"></i>
            <span class="menu-title">Data Feedback</span>
        </a>
    </li>
</ul>
