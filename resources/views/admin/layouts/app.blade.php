<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Perpustakaan</title>

    {{-- SB Admin CSS --}}
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font Awesome (backup untuk icon lama) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .sb-sidenav-dark {
            background-color: #212529 !important;
        }

        #layoutSidenav_nav .nav-link {
            transition: all 0.2s ease;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.6) !important;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        #layoutSidenav_nav .nav-link i {
            font-family: "bootstrap-icons" !important;
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 1.1rem;
            min-width: 20px;
            text-align: center;
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        #layoutSidenav_nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
        }

        #layoutSidenav_nav .nav-link:hover i {
            color: #fff !important;
        }

        #layoutSidenav_nav .nav-link.bg-primary,
        #layoutSidenav_nav .nav-link.active {
            background-color: #0d6efd !important;
            color: white !important;
            font-weight: 600;
        }

        #layoutSidenav_nav .nav-link.bg-primary i,
        #layoutSidenav_nav .nav-link.active i {
            color: white !important;
        }

        .sb-sidenav-footer {
            position: sticky;
            bottom: 0;
            background-color: #1a1d20 !important;
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="sb-nav-fixed">

    @include('admin.layouts.navbar')

    <div id="layoutSidenav">

        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            <footer class="py-3 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Perpustakaan 2026</div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>
</html>