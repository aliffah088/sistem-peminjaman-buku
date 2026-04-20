<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">PinjamAlat</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/alat">Data Alat</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kategori">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="/peminjaman">Peminjaman</a></li>
    
                    <li class="nav-item"><a class="nav-link" href="/pengembalian">Pengembalian</a></li>
                    <li class="nav-item"><a class="nav-link" href="/laporan">Laporan</a></li>
    
                    <li class="nav-item"><a class="nav-link text-danger" href="/logout">Logout</a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>