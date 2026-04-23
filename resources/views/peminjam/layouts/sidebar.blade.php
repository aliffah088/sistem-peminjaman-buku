<div style="width: 240px; min-height: 100vh; background-color: #212529;" class="sidebar d-flex flex-column p-3">

    {{-- Logo / Nama --}}
    <div class="text-white fw-bold fs-5 mb-1">
        <i class="bi bi-book me-2"></i>Perpustakaan
    </div>
    <div class="text-white-50 small mb-4">{{ auth()->user()->name }}</div>

    {{-- Menu --}}
    <ul class="nav flex-column gap-1">

        <li class="nav-item">
            <a href="{{ route('peminjam.dashboard') }}"
               class="nav-link rounded px-3 py-2 fw-semibold
               {{ request()->routeIs('peminjam.dashboard') ? 'bg-primary text-white' : 'text-white-50' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peminjam.alat') }}"
               class="nav-link rounded px-3 py-2 fw-semibold
               {{ request()->routeIs('peminjam.alat') ? 'bg-primary text-white' : 'text-white-50' }}">
                <i class="bi bi-book me-2"></i>Daftar Buku
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peminjam.peminjaman') }}"
               class="nav-link rounded px-3 py-2 fw-semibold
               {{ request()->routeIs('peminjam.peminjaman') ? 'bg-primary text-white' : 'text-white-50' }}">
                <i class="bi bi-hand-index me-2"></i>Peminjaman
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peminjam.pengembalian') }}"
               class="nav-link rounded px-3 py-2 fw-semibold
               {{ request()->routeIs('peminjam.pengembalian') ? 'bg-primary text-white' : 'text-white-50' }}">
                <i class="bi bi-arrow-return-left me-2"></i>Pengembalian
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peminjam.riwayat') }}"
               class="nav-link rounded px-3 py-2 fw-semibold
               {{ request()->routeIs('peminjam.riwayat') ? 'bg-primary text-white' : 'text-white-50' }}">
                <i class="bi bi-clock-history me-2"></i>Riwayat
            </a>
        </li>

    </ul>

    {{-- Logout di bawah --}}
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>

</div>