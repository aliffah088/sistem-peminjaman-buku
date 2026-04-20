@include('admin.layouts.header')

<body class="sb-nav-fixed">

@include('admin.layouts.navbar')

<div id="layoutSidenav">
    
    @include('admin.layouts.sidebar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4 fw-bold">Laporan Peminjaman</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>

                {{-- 🔍 FILTER --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 align-items-end">

                            {{-- FILTER HARIAN --}}
                            <div class="col-md-3">
                                <label class="form-label">Filter Harian</label>
                                <input type="date" name="tanggal" class="form-control"
       value="{{ request('tanggal') }}"
       min="{{ date('Y-m-d') }}">
                            </div>

                            {{-- FILTER BULANAN --}}
                            <div class="col-md-3">
                                <label class="form-label">Filter Bulanan</label>
                                <input type="month" name="bulan" class="form-control"
                                    value="{{ request('bulan') }}">
                            </div>

                            {{-- BUTTON --}}
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Filter
                                </button>

                                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>
                            </div>

                            {{-- PRINT --}}
                            <div class="col-md-3 text-end">
                                <button type="button" onclick="window.print()" class="btn btn-success">
                                    🖨️ Cetak Laporan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- 📊 TABLE --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Peminjam</th>
                                    <th>Alat</th>
                                    <th>Tanggal Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name ?? '-' }}</td>
                                        <td>{{ $item->alat->nama_alat ?? '-' }}</td>

                                        {{-- ✅ FIX DI SINI --}}
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Data peminjaman belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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