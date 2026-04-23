@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-clipboard-check me-2 text-primary"></i>Data Peminjaman
            </h4>
            <small class="text-muted">Kelola seluruh data peminjaman</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Daftar Peminjaman
            </span>
            <span class="badge bg-primary rounded-pill">
                {{ $peminjaman->count() }} data
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 50px;">No</th>
                            <th>Nama User</th>
                            <th>Nama Buku</th>
                            <th class="text-center">Tgl Pinjam</th>
                            <th class="text-center">Tgl Rencana Kembali</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $index => $p)
                        <tr>
                            <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $p->user->name ?? '-' }}</div>
                                <small class="text-muted">{{ $p->user->email ?? '' }}</small>
                            </td>
                            <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                            <td class="text-center text-muted">
                                {{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d-m-Y') : '-' }}
                            </td>
                            <td class="text-center text-muted">
                                {{ $p->tgl_rencana_kembali ? \Carbon\Carbon::parse($p->tgl_rencana_kembali)->format('d-m-Y') : '-' }}
                            </td>
                            <td class="text-center">
                                @php
                                    $badge = match($p->status) {
                                        'dipinjam'     => 'warning',
                                        'disetujui'    => 'success',
                                        'menunggu'     => 'info',
                                        'ditolak'      => 'danger',
                                        'dikembalikan' => 'secondary',
                                        default        => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection