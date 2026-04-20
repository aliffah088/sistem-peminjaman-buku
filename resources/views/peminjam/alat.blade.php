@extends('peminjam.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📦 Daftar Alat</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
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
                            <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                @if($a->stok > 0)
                                    <span class="badge bg-success">{{ $a->stok }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($a->stok > 0)
                                    {{-- ✅ kirim id_alat bukan alat_id --}}
                                    <a href="{{ route('peminjam.peminjaman', ['id_alat' => $a->id_alat]) }}"
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
                            <td colspan="5" class="text-center text-muted">Tidak ada data alat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection