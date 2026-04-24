@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner --}}
    <div class="card border-0 shadow-sm mb-4 bg-dark text-white" style="border-radius: 16px;">
        <div class="card-body p-4 d-flex align-items-center gap-4">
            <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                 style="width: 60px; height: 60px; min-width: 60px;">
                <i class="bi bi-shield-check fs-3 text-white"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
                <p class="mb-0 opacity-75">Kelola sistem perpustakaan dengan mudah dan efisien.</p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-people text-primary fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">TOTAL PEMINJAM</div>
                        <div class="fs-3 fw-bold text-primary">{{ $totalPeminjam ?? 0 }}</div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <a href="{{ route('admin.users.index') }}" class="small text-decoration-none text-primary">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-book text-warning fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">SEDANG DIPINJAM</div>
                        <div class="fs-3 fw-bold text-warning">{{ $sedangDipinjam ?? 0 }}</div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <a href="{{ route('admin.peminjaman.index') }}" class="small text-decoration-none text-warning">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-person-check text-success fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">TOTAL PENGGUNA</div>
                        <div class="fs-3 fw-bold text-success">{{ $totalPengguna ?? 0 }}</div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <a href="{{ route('admin.users.index') }}" class="small text-decoration-none text-success">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; min-width: 50px;">
                        <i class="bi bi-exclamation-circle text-danger fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-semibold">TERLAMBAT DIKEMBALIKAN</div>
                        <div class="fs-3 fw-bold text-danger">{{ $terlambat ?? 0 }}</div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <a href="{{ route('admin.pengembalian.index') }}" class="small text-decoration-none text-danger">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection