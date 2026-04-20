<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

    <div class="sb-sidenav-menu">
        <div class="nav">

            <!-- Dashboard -->
            <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" 
               href="{{ route('petugas.dashboard') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                Dashboard
            </a>

            <!-- Peminjaman -->
            <a class="nav-link {{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}" 
               href="{{ route('petugas.peminjaman.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                Peminjaman
            </a>

            <!-- Pengembalian -->
            <a class="nav-link {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}" 
               href="{{ route('petugas.pengembalian.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-undo"></i>
                </div>
                Pengembalian
            </a>

            <!-- Laporan -->
            <a class="nav-link" href="{{ route('petugas.laporan.index') }}">
            <div class="sb-nav-link-icon">
                <i class="fas fa-file-alt"></i> {{-- INI ICON LAPORAN --}}
            </div>
            Laporan
        </a>

    </div>
</div>

        </div>
    </div>

    <!-- Footer -->
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Petugas
    </div>

</nav>