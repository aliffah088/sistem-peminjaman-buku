@include('admin.layouts.header')

<body class="sb-nav-fixed">

@include('admin.layouts.navbar')

<div id="layoutSidenav">
    
    @include('admin.layouts.sidebar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4 fw-bold">Data Kategori</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>

                <a href="{{ route('admin.kategoris.create') }}" 
                   class="btn btn-primary mb-3">
                    + Tambah Kategori
                </a>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('admin.kategoris.edit', $item) }}"
                                           class="btn btn-warning btn-sm">
                                           Edit
                                        </a>

                                        <form action="{{ route('admin.kategoris.destroy', $item) }}"
                                              method="POST" 
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Data kategori belum ada.
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
