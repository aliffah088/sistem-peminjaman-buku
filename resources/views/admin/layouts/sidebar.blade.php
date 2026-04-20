<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- Dashboard -->
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Dashboard
                    </a>

                    <!-- Kategori -->
                    <a class="nav-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}" 
                       href="{{ route('admin.kategoris.index') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-columns"></i>
                        </div>
                        Kategori
                    </a>

                    <!-- Alat -->
                    <a class="nav-link {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}" 
                       href="{{ route('admin.alat.index') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        Alat
                    </a>

                 <!-- Laporan -->
<a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" 
   href="{{ route('admin.laporan.index') }}">
    <div class="sb-nav-link-icon">
        <i class="fas fa-file-alt"></i>
    </div>
    Laporan
</a>

<!-- Log Aktivitas -->
<a class="nav-link {{ request()->routeIs('admin.log.*') ? 'active' : '' }}" 
   href="{{ route('admin.log.index') }}">
    <div class="sb-nav-link-icon">
        <i class="fas fa-history"></i>
    </div>
    Log Aktivitas
</a>
<!-- User -->
<a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
   href="{{ route('admin.users.index') }}">
    <div class="sb-nav-link-icon">
        <i class="fas fa-user"></i>
    </div>
    User
</a>
<!-- Data Peminjaman -->
<a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}" 
   href="{{ route('admin.peminjaman.index') }}">
    <div class="sb-nav-link-icon">
        <i class="fas fa-box"></i>
    </div>
    Data Peminjaman
</a>
<!-- Pengembalian -->
<a class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}" 
   href="{{ route('admin.pengembalian.index') }}">
    <div class="sb-nav-link-icon">
        <i class="fas fa-undo"></i>
    </div>
    Pengembalian
</a>

            <!-- Footer -->
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Halaman Admin
            </div>

        </nav>
    </div>
</div>