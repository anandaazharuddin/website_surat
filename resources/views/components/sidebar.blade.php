<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- Brand Logo -->
        <div class="sidebar-brand">
            <a href="{{ url('/') }}" class="text-primary fw-bold">SURAT PJT 1</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}" class="text-primary fw-bold">SP</a>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>
            <!-- Kotak Surat -->
            <li class="menu-header">Surat</li>
            <li class="{{ Request::is('surat*') ? 'active' : '' }}">
                <a href="{{ route('surat.index') }}" class="nav-link">
                    <i class="fas fa-envelope"></i> <span>Buat Surat</span>
                </a>
            </li>
            <li class="{{ Request::is('suratMasuk') ? 'active' : '' }}">
                <a href="{{ url('/surat/masuk') }}" class="nav-link">
                    <i class="fas fa-inbox"></i> <span>Kotak Masuk</span>
                </a>
            </li>
            <li class="{{ Request::is('suratKeluar') ? 'active' : '' }}">
                <a href="{{ route('surat.keluar') }}" class="nav-link">
                    <i class="fas fa-paper-plane"></i> <span>Kotak Keluar</span>
                </a>
            </li>
            
        </ul>   
    </aside>
</div>
