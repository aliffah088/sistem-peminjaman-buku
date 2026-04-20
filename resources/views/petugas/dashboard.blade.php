@extends('petugas.layouts.app')

@section('content')

<div class="container-fluid px-4">

    <h1 class="mt-4 fw-bold">Dashboard Petugas</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row g-4">

        <!-- Total Peminjaman -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase">Total Peminjaman</h6>
                    <h3 class="fw-bold mt-2">
                        {{ $totalPeminjaman ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Sedang Dipinjam -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-warning text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase">Sedang Dipinjam</h6>
                    <h3 class="fw-bold mt-2">
                        {{ $sedangDipinjam ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Sudah Dikembalikan -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase">Sudah Dikembalikan</h6>
                    <h3 class="fw-bold mt-2">
                        {{ $sudahKembali ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Terlambat -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 bg-danger text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase">Terlambat</h6>
                    <h3 class="fw-bold mt-2">
                        {{ $terlambat ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection