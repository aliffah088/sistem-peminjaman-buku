<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <span class="navbar-brand fw-bold">
            Sistem Peminjaman Alat
        </span>

        <div class="text-white">
            {{ auth()->user()->username }}
            <span class="badge bg-info text-dark ms-2">
                {{ strtoupper(auth()->user()->role) }}
            </span>
        </div>
    </div>
</nav>
