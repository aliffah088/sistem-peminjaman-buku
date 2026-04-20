@include('admin.layouts.header')

<body class="sb-nav-fixed">

@include('admin.layouts.navbar')

<div id="layoutSidenav">
    
    @include('admin.layouts.sidebar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4 fw-bold">Log Aktivitas</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Log Aktivitas</li>
                </ol>

                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <p class="mb-0 text-muted">
                            Belum ada data log aktivitas.
                        </p>
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