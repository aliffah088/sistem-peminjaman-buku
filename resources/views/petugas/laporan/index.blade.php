@extends('petugas.layouts.app')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4 fw-bold">📊 Laporan Peminjaman & Pengembalian</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Laporan</li>
    </ol>

    {{-- FILTER --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Tanggal
        </div>
        <div class="card-body">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Filter
                        </button>

                        <a href="{{ route('petugas.laporan.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Laporan
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Alat</th>
                            <th>Tgl Pinjam</th>
                            <th>Rencana Kembali</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data ?? [] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                            <td>{{ $item->tgl_pinjam }}</td>
                            <td>{{ $item->tgl_rencana_kembali }}</td>
                            <td>{{ $item->pengembalian->tgl_kembali ?? '-' }}</td>

                            <td>
                                @if($item->status == 'dipinjam')
                                    <span class="badge bg-warning">Dipinjam</span>
                                @elseif($item->status == 'kembali')
                                    <span class="badge bg-success">Kembali</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                @endif
                            </td>

                            <td>
                                @if(isset($item->pengembalian))
                                    Rp {{ number_format($item->pengembalian->denda ?? 0, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Data tidak ada</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

@endsection