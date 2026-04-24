@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0"><i class="bi bi-journal-bookmark me-2 text-primary"></i>Data Buku</h4>
            <small class="text-muted">Kelola seluruh data buku perpustakaan</small>
        </div>
        <a href="{{ route('admin.alat.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="liveSearch" class="form-control border-start-0"
                               placeholder="Cari judul, penulis, ISBN..."
                               value="{{ request('search') }}"
                               autocomplete="off">
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="filterKategori" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris ?? [] as $k)
                            <option value="{{ strtolower($k->nama_kategori) }}"
                                {{ request('kategori') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button onclick="resetFilter()" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Daftar Buku
            </span>
            <span class="badge bg-primary rounded-pill" id="jumlahBuku">
                {{ $alat->count() }} buku
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tableBuku">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-center ps-4" style="width: 50px;">No</th>
                            <th class="text-center" style="width: 80px;">Cover</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th class="text-center" style="width: 70px;">Tahun</th>
                            <th>Kategori</th>
                            <th class="text-center" style="width: 70px;">Stok</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">
                        @forelse ($alat as $a)
                        <tr class="buku-row"
                            data-judul="{{ strtolower($a->nama_alat) }}"
                            data-penulis="{{ strtolower($a->penulis ?? '') }}"
                            data-isbn="{{ strtolower($a->isbn ?? '') }}"
                            data-kategori="{{ strtolower(optional($a->kategori)->nama_kategori ?? '') }}">
                            <td class="text-center ps-4 text-muted row-number">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($a->gambar)
                                    <img src="{{ asset($a->gambar) }}"
                                         alt="Cover"
                                         class="rounded shadow-sm"
                                         style="width: 45px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 45px; height: 60px;">
                                        <i class="bi bi-book text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $a->nama_alat }}</div>
                                @if($a->isbn)
                                    <small class="text-muted">ISBN: {{ $a->isbn }}</small>
                                @endif
                            </td>
                            <td class="text-muted">{{ $a->penulis ?? '-' }}</td>
                            <td class="text-muted">{{ $a->penerbit ?? '-' }}</td>
                            <td class="text-center text-muted">{{ $a->tahun_terbit ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill">
                                    {{ optional($a->kategori)->nama_kategori ?? 'Belum ada' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($a->stok > 5)
                                    <span class="badge bg-success rounded-pill px-3">{{ $a->stok }}</span>
                                @elseif($a->stok > 0)
                                    <span class="badge bg-warning text-dark rounded-pill px-3">{{ $a->stok }}</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3">0</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.alat.edit', $a->id) }}"
                                   class="btn btn-warning btn-sm text-white me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.alat.destroy', $a->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus buku {{ $a->nama_alat }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Data buku tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    const searchInput   = document.getElementById('liveSearch');
    const filterKategori = document.getElementById('filterKategori');

    function filterTable() {
        const keyword  = searchInput.value.toLowerCase();
        const kategori = filterKategori.value.toLowerCase();
        const rows     = document.querySelectorAll('.buku-row');
        let visible    = 0;

        rows.forEach(row => {
            const judul    = row.dataset.judul;
            const penulis  = row.dataset.penulis;
            const isbn     = row.dataset.isbn;
            const kat      = row.dataset.kategori;

            const matchSearch   = judul.includes(keyword) || penulis.includes(keyword) || isbn.includes(keyword);
            const matchKategori = kategori === '' || kat.includes(kategori);

            if (matchSearch && matchKategori) {
                row.style.display = '';
                visible++;
                row.querySelector('.row-number').textContent = visible;
            } else {
                row.style.display = 'none';
            }
        });

        // Update badge jumlah
        document.getElementById('jumlahBuku').textContent = visible + ' buku';

        // Tampilkan pesan kosong jika tidak ada hasil
        let noResult = document.getElementById('noResult');
        if (visible === 0) {
            if (!noResult) {
                const tbody = document.getElementById('tablebody');
                const tr = document.createElement('tr');
                tr.id = 'noResult';
                tr.innerHTML = `<td colspan="9" class="text-center text-muted py-5">
                    <i class="bi bi-search fs-3 d-block mb-2"></i>
                    Buku tidak ditemukan.
                </td>`;
                tbody.appendChild(tr);
            }
        } else {
            if (noResult) noResult.remove();
        }
    }

    function resetFilter() {
        searchInput.value = '';
        filterKategori.value = '';
        filterTable();
    }

    searchInput.addEventListener('input', filterTable);
    filterKategori.addEventListener('change', filterTable);
</script>

@endsection