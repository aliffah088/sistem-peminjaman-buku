@extends('peminjam.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-2 fw-bold">📚 Daftar Buku</h1>
    <p class="text-muted">Koleksi buku tersedia</p>

    <div class="row g-4">
        @forelse($alats as $item)
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">

                {{-- FOTO BUKU --}}
                <div style="height: 200px; overflow: hidden; background-color: #f0f0f0;">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}"
                             alt="{{ $item->nama_alat }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-secondary bg-opacity-10">
                            <i class="bi bi-book fs-1 text-secondary"></i>
                        </div>
                    @endif
                </div>

                {{-- INFO BUKU --}}
                <div class="card-body d-flex flex-column p-3">
                    <h6 class="fw-bold mb-1" style="font-size: 0.9rem; line-height: 1.3;">
                        {{ $item->nama_alat }}
                    </h6>
                    <p class="text-muted mb-1" style="font-size: 0.8rem;">
                        <i class="bi bi-tag me-1"></i>{{ $item->kategori->nama_kategori ?? 'Fiksi' }}
                    </p>
                    @if($item->penulis)
                    <p class="text-muted mb-1" style="font-size: 0.8rem;">
                        <i class="bi bi-person me-1"></i>{{ $item->penulis }}
                    </p>
                    @endif

                    <div class="mt-auto pt-2">
                        <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }} mb-2">
                            {{ $item->stok > 0 ? 'Stok: ' . $item->stok : 'Habis' }}
                        </span>
                        <div>
                            @if($item->stok > 0)
                                <a href="{{ route('peminjam.peminjaman') }}"
                                   class="btn btn-primary btn-sm w-100 rounded-pill">
                                    <i class="bi bi-hand-index me-1"></i>Pinjam
                                </a>
                            @else
                                <button class="btn btn-secondary btn-sm w-100 rounded-pill" disabled>
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Belum ada buku tersedia
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection