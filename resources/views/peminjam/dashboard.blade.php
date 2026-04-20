@extends('peminjam.layouts.app')

@section('content')

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">

            <h1 class="mt-4 fw-bold">Dashboard Peminjam</h1>

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
                                {{ $total ?? 0 }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Menunggu -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 bg-warning text-white h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase">Menunggu</h6>
                            <h3 class="fw-bold mt-2">
                                {{ $menunggu ?? 0 }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Disetujui -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 bg-success text-white h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase">Disetujui</h6>
                            <h3 class="fw-bold mt-2">
                                {{ $disetujui ?? 0 }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Ditolak -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 bg-danger text-white h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase">Ditolak</h6>
                            <h3 class="fw-bold mt-2">
                                {{ $ditolak ?? 0 }}
                            </h3>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</div>

@endsection