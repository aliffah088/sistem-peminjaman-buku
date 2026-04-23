@extends('peminjam.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-1">📜 Riwayat Peminjaman</h2>
    <p class="text-secondary mb-4">Daftar semua aktivitas peminjaman kamu.</p>

    <div class="card border-0 shadow-sm" style="border-radius:15px;">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">No</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3">Tgl Pinjam</th>
                        <th class="py-3">Tgl Kembali</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">{{ $r->alat->nama_alat ?? '-' }}</td>
                        <td>{{ $r->tgl_pinjam }}</td>
                        <td>{{ $r->tgl_kembali ?? '-' }}</td>
                        <td>
                            @if($r->status == 'dipinjam')
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Masih Dipinjam</span>
                            @elseif($r->status == 'menunggu')
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Menunggu</span>
                            @elseif($r->status == 'ditolak')
                                <span class="badge bg-danger px-3 py-2 rounded-pill">Ditolak</span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill">Sudah Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-5 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>Belum ada riwayat peminjaman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection