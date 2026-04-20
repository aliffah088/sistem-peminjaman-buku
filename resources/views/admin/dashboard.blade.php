@include('admin.layouts.header')

<body class="sb-nav-fixed">

@include('admin.layouts.navbar')

<div id="layoutSidenav">
    
    <div id="layoutSidenav_nav">
        @include('admin.layouts.sidebar')
    </div>

    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4 fw-bold">Dashboard Admin</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="row g-4">

                    <!-- Total Peminjam -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-primary text-white h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase">Total Peminjam</h6>
                                <h3 class="fw-bold mt-2">
                                    {{ $totalPeminjam ?? 0 }}
                                </h3>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a class="small text-white stretched-link text-decoration-none" href="#">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sedang Dipinjam -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-warning text-white h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase">Sedang Dipinjam</h6>
                                <h3 class="fw-bold mt-2">
                                    {{ $sedangDipinjam ?? 0 }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengguna -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-success text-white h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase">Total Pengguna</h6>
                                <h3 class="fw-bold mt-2">
                                    {{ $totalPengguna ?? 0 }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Terlambat -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 bg-danger text-white h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase">Terlambat Dikembalikan</h6>
                                <h3 class="fw-bold mt-2">
                                    {{ $terlambat ?? 0 }}
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="text-muted small text-center">
                    Sistem Peminjaman
                </div>
            </div>
        </footer>

    </div>
</div>

@include('admin.layouts.footer')

</body>
</html>