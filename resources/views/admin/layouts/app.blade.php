<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- WAJIB -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SB ADMIN CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />

    <!-- FONT AWESOME -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- NAVBAR -->
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">

        <!-- SIDEBAR -->
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>

            <!-- OPTIONAL FOOTER -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="text-muted small">
                        &copy; Your Website 2026
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SB ADMIN JS -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>
</html>