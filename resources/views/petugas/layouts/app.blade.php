@include('layouts.header')

<body class="sb-nav-fixed">

@include('layouts.navbar')

<div id="layoutSidenav">
    
    <!-- SIDEBAR -->
    <div id="layoutSidenav_nav">
        @include('petugas.sidebar')
    </div>

    <!-- CONTENT -->
    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4">
                
                {{-- ISI HALAMAN MASUK SINI --}}
                @yield('content')

            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="text-muted small text-center">
                    Sistem Peminjaman - Petugas
                </div>
            </div>
        </footer>

    </div>
</div>

@include('layouts.footer')

</body>
</html>