@extends('peminjam.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-1">🔄 Pengembalian Buku</h2>
    <p class="text-secondary mb-4">Kelola buku yang sedang kamu pinjam di sini.</p>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius:15px;">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Judul Buku</th>
                        <th class="py-3">Tgl Pinjam</th>
                        <th class="py-3">Batas Kembali</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $p->alat->nama_alat ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $p->tgl_pinjam }}</span></td>
                        <td><span class="badge bg-light text-danger border">{{ $p->tgl_rencana_kembali }}</span></td>
                        <td class="text-center">
                            <form action="{{ route('pengembalian.update', $p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm rounded-pill px-4">
                                    <i class="bi bi-check2-square me-1"></i>Kembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>Tidak ada buku yang sedang dipinjam.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection