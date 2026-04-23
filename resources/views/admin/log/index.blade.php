@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>Log Aktivitas
            </h4>
            <small class="text-muted">Riwayat seluruh aktivitas sistem</small>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Daftar Log
            </span>
            <span class="badge bg-primary rounded-pill">
                {{ $logs->count() }} data
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 60px;">No</th>
                            <th>Nama User</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs ?? [] as $log)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $log->nama_user ?? '-' }}</td>
                            <td>
                                <span class="badge bg-primary rounded-pill px-3">
                                    {{ $log->aksi ?? '-' }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $log->deskripsi ?? '-' }}</td>
                            <td class="text-muted">
                                {{ $log->created_at ? $log->created_at->format('d-m-Y H:i') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada log aktivitas.
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