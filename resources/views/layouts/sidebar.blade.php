@php
use App\Models\Vip;
$jumlah_vip_proses = Vip::where('status', 'Proses')->count();
@endphp

<div class="sidebar">
    <ul class="nav flex-column">
        <img src="{{ asset('img/logodinas.png') }}" alt="" style="max-width: 150px; max-height: 80px; display: block; margin: auto; margin-top: 13px; margin-bottom: 15px;" />
        <h4 class="judul text-center">Pantau Tamu Pro</h4><br>
     
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('struktur') }}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Struktur Organisasi</span>
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
        @if($jumlah_vip_proses > 0)
            &nbsp;&nbsp; &nbsp;&nbsp;<i class="fas fa-exclamation-circle text-warning"><span class="badge badge-warning">New</span></i>
    
        @endif

    </a>
</li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.index') }}">
                <i class="ti-view-list-alt menu-icon"></i>
                <span class="menu-title">Manajamen Akun</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('survey.index') }}">
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
</div>

