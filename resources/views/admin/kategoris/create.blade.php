@include('admin.layouts.header')

<body class="sb-nav-fixed">

@include('admin.layouts.navbar')

<div id="layoutSidenav">
    @include('admin.layouts.sidebar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Tambah Kategori</h1>

                <div class="card shadow">
                    <div class="card-body">

                        <form action="{{ route('admin.kategoris.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text"
                                       name="nama_kategori"
                                       class="form-control"
                                       value="{{ old('nama_kategori') }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi"
                                          class="form-control"
                                          rows="3">{{ old('deskripsi') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>

                            <a href="{{ route('admin.kategoris.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                        </form>

                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

