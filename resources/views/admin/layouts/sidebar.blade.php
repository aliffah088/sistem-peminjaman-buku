<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #212529;">

        <div class="sb-sidenav-menu">
            <div class="nav flex-column gap-1 p-2">

                {{-- Header --}}
                <div class="px-2 py-3 mb-2">
                    <h5 class="fw-bold text-white mb-0">
                        <i class="bi bi-grid-1x2 me-2"></i>Perpustakaan
                    </h5>
                    <small class="text-white-50">Admin: {{ auth()->user()->name }}</small>
                </div>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-speedometer2"></i> 
                    <span>Dashboard</span>
                </a>

                {{-- Kategori --}}
                <a href="{{ route('admin.kategoris.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.kategoris.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-grid"></i> 
                    <span>Kategori</span>
                </a>

                {{-- Buku --}}
                <a href="{{ route('admin.alat.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.alat.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-journal-bookmark"></i> 
                    <span>Buku</span>
                </a>

                {{-- Data Peminjaman --}}
                <a href="{{ route('admin.peminjaman.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.peminjaman.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-clipboard-check"></i> 
                    <span>Data Peminjaman</span>
                </a>

                {{-- Pengembalian --}}
                <a href="{{ route('admin.pengembalian.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.pengembalian.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-arrow-return-left"></i> 
                    <span>Pengembalian</span>
                </a>

                {{-- Laporan --}}
                <a href="{{ route('admin.laporan.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.laporan.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-bar-chart-line"></i> 
                    <span>Laporan</span>
                </a>

                {{-- Log Aktivitas --}}
                <a href="{{ route('admin.log.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.log.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-clock-history"></i> 
                    <span>Log Aktivitas</span>
                </a>

                {{-- User --}}
                <a href="{{ route('admin.users.index') }}"
                   class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded mb-1
                   {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white fw-semibold active' : 'text-white-50' }}">
                    <i class="bi bi-people"></i> 
                    <span>User</span>
                </a>

            </div>
        </div>

        {{-- Footer --}}
        <div class="sb-sidenav-footer p-3 mt-auto" style="background-color: rgba(0,0,0,0.1);">
            <div class="small text-white-50">
                <i class="bi bi-person-circle me-1"></i> Terhubung sebagai Admin
            </div>
        </div>

    </nav>
</div>

{{-- Tambahkan CSS Tambahan untuk memastikan link hover --}}
<style>
    .nav-link {
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff !important;
    }
    .nav-link.active i {
        color: white !important;
    }
</style>

<style>
    /* Paksa semua icon di dalam nav-link agar berwarna putih */
    .nav-link i {
        color: #ffffff !important; 
        font-size: 1.2rem; /* Ukuran icon diperbesar sedikit agar terlihat */
        display: inline-block;
    }

    /* Warna icon saat menu aktif */
    .nav-link.bg-primary i {
        color: #ffffff !important;
    }
</style>