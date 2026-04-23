@extends('peminjam.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📚 Daftar Buku</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM SEARCH & FILTER --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('peminjam.alat') }}" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari judul atau penulis..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris ?? [] as $k)
                            <option value="{{ $k->id }}"
                                {{ request('kategori') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alat as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->nama_alat }}</td>
                            <td>{{ $a->penulis ?? '-' }}</td>
                            <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                @if($a->stok > 0)
                                    <span class="badge bg-success">{{ $a->stok }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($a->stok > 0)
                                    {{-- ✅ Redirect ke halaman peminjaman dengan alat_id --}}
                                    <a href="{{ route('peminjam.peminjaman', ['alat_id' => $a->id]) }}"
                                       class="btn btn-primary btn-sm">
                                        Pinjam
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data alat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection