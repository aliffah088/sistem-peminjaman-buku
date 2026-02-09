<x-layouts.app>
    <x-slot:title>Dashboard</x-slot>

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 bg-white shadow-sm rounded border-start border-primary border-4">
                <h3 class="fw-bold mb-1">
                    Halo, {{ auth()->user()->username }} 👋
                </h3>
                <p class="text-muted mb-0">
                    Kamu login sebagai
                    <span class="badge bg-info text-dark">
                        {{ strtoupper(auth()->user()->role) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- CARD STAT -->
    <div class="row">

        <!-- Total Alat -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase small">Total Alat Tersedia</h6>
                    <h2 class="fw-bold">{{ $totalAlat }}</h2>
                    <i class="bi bi-tools fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100">
                <div class="card-body">
                    <h6 class="text-uppercase small">
                        {{ auth()->user()->role == 'peminjam'
                            ? 'Alat Yang Kamu Pinjam'
                            : 'Alat Sedang Dipinjam' }}
                    </h6>
                    <h2 class="fw-bold">{{ $pinjamanAktif }}</h2>
                    <i class="bi bi-cart-check fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Total User (ADMIN) -->
        @if(auth()->user()->role == 'admin')
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase small">Total Pengguna</h6>
                    <h2 class="fw-bold">{{ $totalUser }}</h2>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        @endif

        <!-- Terlambat -->
        @if(auth()->user()->role != 'peminjam')
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-danger text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase small">Terlambat Dikembalikan</h6>
                    <h2 class="fw-bold">{{ $perluDikembalikan ?? 0 }}</h2>
                    <i class="bi bi-exclamation-triangle fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        @endif

    </div>
</x-layouts.app>
