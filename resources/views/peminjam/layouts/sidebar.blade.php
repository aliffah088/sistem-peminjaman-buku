<div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
    
    <h4 class="mb-4">Peminjam</h4>

    <ul class="nav flex-column">

        <li class="nav-item mb-2">
            <a href="{{ route('peminjam.dashboard') }}" class="nav-link text-white">
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('peminjam.alat') }}" class="nav-link text-white">
                Daftar Alat
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('peminjam.peminjaman') }}" class="nav-link text-white">
                Peminjaman Saya
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('peminjam.riwayat') }}" class="nav-link text-white">
                Riwayat
            </a>
        </li>

        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">Logout</button>
            </form>
        </li>

    </ul>

</div>