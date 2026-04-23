@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard Admin
        </h4>
        <small class="text-muted">Selamat datang, {{ auth()->user()->name }}</small>
    </div>

    <div class="row g-4">

        {{-- Total Peminjam --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Total Peminjam</h6>
                            <h2 class="fw-bold mb-0">{{ $totalPeminjam ?? 0 }}</h2>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a class="small text-white text-decoration-none" href="{{ route('admin.users.index') }}">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sedang Dipinjam --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Sedang Dipinjam</h6>
                            <h2 class="fw-bold mb-0">{{ $sedangDipinjam ?? 0 }}</h2>
                        </div>
                        <i class="bi bi-book fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pengguna --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Total Pengguna</h6>
                            <h2 class="fw-bold mb-0">{{ $totalPengguna ?? 0 }}</h2>
                        </div>
                        <i class="bi bi-person-check fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terlambat --}}
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-white-50 small">Terlambat Dikembalikan</h6>
                            <h2 class="fw-bold mb-0">{{ $terlambat ?? 0 }}</h2>
                        </div>
                        <i class="bi bi-exclamation-circle fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection