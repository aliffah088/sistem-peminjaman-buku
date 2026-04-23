@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold">Dashboard Peminjam</h1>
    <p class="text-secondary mb-4">Akses cepat layanan perpustakaan untuk kamu, <strong>{{ auth()->user()->name }}</strong>.</p>

    <div class="row">
        {{-- KOTAK DAFTAR BUKU --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-book-open fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0">Cari Buku</h5>
                        <small class="opacity-75">Lihat koleksi kami</small>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small bg-dark bg-opacity-10 border-0">
                    <a class="text-white stretched-link text-decoration-none" href="{{ route('peminjam.alat') }}">Buka Katalog</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- KOTAK PINJAM BUKU --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-plus-circle fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0">Pinjam Baru</h5>
                        <small class="opacity-75">Proses peminjaman</small>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small bg-dark bg-opacity-10 border-0">
                    <a class="text-white stretched-link text-decoration-none" href="{{ route('peminjam.peminjaman') }}">Klik di sini</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- KOTAK PENGEMBALIAN --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-reply fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0">Kembalikan</h5>
                        <small class="opacity-75">Buku yang dipinjam</small>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small bg-dark bg-opacity-10 border-0">
                    <a class="text-dark stretched-link text-decoration-none" href="{{ route('peminjam.pengembalian') }}">Lihat daftar</a>
                    <div class="text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        {{-- KOTAK RIWAYAT --}}
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-history fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0">Riwayat</h5>
                        <small class="opacity-75">Catatan pinjaman</small>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small bg-dark bg-opacity-10 border-0">
                    <a class="text-white stretched-link text-decoration-none" href="{{ route('peminjam.riwayat') }}">Cek riwayat</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- AREA INFO TAMBAHAN --}}
    <div class="card border-0 shadow-sm mt-2">
        <div class="card-body p-4 text-center">
            <h4 class="fw-bold">Butuh Bantuan?</h4>
            <p class="text-muted">Jika ada kendala saat meminjam atau mengembalikan buku, silakan hubungi petugas perpustakaan.</p>
        </div>
    </div>
</div>
@endsection