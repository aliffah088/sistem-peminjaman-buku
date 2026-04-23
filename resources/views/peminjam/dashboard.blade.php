@extends('peminjam.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner --}}
    <div class="card border-0 shadow-sm mb-4 bg-primary text-white"
         style="border-radius: 16px;">
        <div class="card-body p-4 d-flex align-items-center gap-4">
            <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                 style="width: 60px; height: 60px; min-width: 60px;">
                <i class="bi bi-person fs-3 text-white"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
                <p class="mb-0 opacity-75">Senang melihat kamu kembali di sistem perpustakaan.</p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-book text-primary fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">TOTAL PEMINJAMAN</div>
                        <div class="fs-3 fw-bold text-primary">{{ $totalPeminjaman }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-hourglass-split text-warning fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">MENUNGGU</div>
                        <div class="fs-3 fw-bold text-warning">{{ $menunggu }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-check-circle text-success fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">DISETUJUI</div>
                        <div class="fs-3 fw-bold text-success">{{ $disetujui }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-x-circle text-danger fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">DITOLAK</div>
                        <div class="fs-3 fw-bold text-danger">{{ $ditolak }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">

        {{-- Peminjaman Terakhir --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-3 px-4">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Peminjaman Terakhir
                    </h6>
                </div>
                <div class="card-body p-0">
                    @forelse($peminjamanTerbaru as $item)
                    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded p-2">
                                <i class="bi bi-book text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-semibold small">{{ $item->alat->nama_alat ?? '-' }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        @php
                            $badge = match($item->status) {
                                'dipinjam'     => 'warning',
                                'dikembalikan' => 'success',
                                'menunggu'     => 'info',
                                'ditolak'      => 'danger',
                                default        => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }} rounded-pill">{{ ucfirst($item->status) }}</span>
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada peminjaman
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Belum Dikembalikan --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-3 px-4">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-exclamation-triangle me-2 text-danger"></i>Belum Dikembalikan
                    </h6>
                </div>
                <div class="card-body p-0">
                    @forelse($belumKembali as $item)
                    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-danger bg-opacity-10 rounded p-2">
                                <i class="bi bi-book text-danger"></i>
                            </div>
                            <div>
                                <div class="fw-semibold small">{{ $item->alat->nama_alat ?? '-' }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    Dipinjam: {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-danger rounded-pill">Belum Kembali</span>
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-check-circle fs-3 d-block mb-2 text-success"></i>
                        Semua buku sudah dikembalikan 🎉
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection