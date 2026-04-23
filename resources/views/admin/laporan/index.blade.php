@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-bar-chart-line me-2 text-primary"></i>Laporan Peminjaman
            </h4>
            <small class="text-muted">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a>
                / Laporan
            </small>
        </div>
        <button type="button" onclick="window.print()" class="btn btn-success d-flex align-items-center gap-2">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>

    {{-- Filter --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter Harian</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter Bulanan</label>
                    <input type="month" name="bulan" class="form-control"
                           value="{{ request('bulan') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Data Peminjaman
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
                            <th class="ps-4" style="width: 60px;">No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Rencana Kembali</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ $item->user->name ?? '-' }}</div>
                                <small class="text-muted">{{ $item->user->email ?? '' }}</small>
                            </td>
                            <td class="fw-semibold">{{ $item->alat->nama_alat ?? '-' }}</td>
                            <td class="text-muted">{{ $item->created_at->format('d-m-Y') }}</td>
                            <td class="text-muted">
                                {{ $item->tgl_rencana_kembali
                                    ? \Carbon\Carbon::parse($item->tgl_rencana_kembali)->format('d-m-Y')
                                    : '-' }}
                            </td>
                            <td class="text-center">
                                @php
                                    $badge = match($item->status) {
                                        'dipinjam'     => 'warning',
                                        'dikembalikan' => 'success',
                                        'menunggu'     => 'info',
                                        'ditolak'      => 'danger',
                                        default        => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                    {{ ucfirst($item->status) }}
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