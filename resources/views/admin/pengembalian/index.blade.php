@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-arrow-return-left me-2 text-primary"></i>Data Pengembalian
            </h4>
            <small class="text-muted">Kelola seluruh data pengembalian buku</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Daftar Pengembalian
            </span>
            <span class="badge bg-primary rounded-pill">
                {{ $pengembalian->count() }} data
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 50px;">No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Buku</th>
                            <th class="text-center">Tgl Pinjam</th>
                            <th class="text-center">Tgl Kembali</th>
                            <th class="text-center">Terlambat</th>
                            <th class="text-center">Denda</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengembalian as $item)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>

                            {{-- Peminjam --}}
                            <td>
                                <div class="fw-semibold">
                                    {{ optional(optional($item->peminjaman)->user)->name ?? '-' }}
                                </div>
                                <small class="text-muted">
                                    {{ optional(optional($item->peminjaman)->user)->email ?? '' }}
                                </small>
                            </td>

                            {{-- Nama Buku --}}
                            <td>{{ optional(optional($item->peminjaman)->alat)->nama_alat ?? '-' }}</td>

                            {{-- Tgl Pinjam --}}
                            <td class="text-center text-muted">
                                {{ optional($item->peminjaman)->tgl_pinjam
                                    ? \Carbon\Carbon::parse($item->peminjaman->tgl_pinjam)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            {{-- Tgl Kembali --}}
                            <td class="text-center text-muted">
                                {{ $item->tgl_kembali
                                    ? \Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            {{-- Terlambat --}}
                            <td class="text-center">
                                @if($item->terlambat > 0)
                                    <span class="badge bg-warning text-dark rounded-pill px-3">
                                        {{ $item->terlambat }} hari
                                    </span>
                                @else
                                    <span class="badge bg-success rounded-pill px-3">Tepat Waktu</span>
                                @endif
                            </td>

                            {{-- Denda --}}
                            <td class="text-center">
                                @if($item->denda > 0)
                                    <span class="badge bg-danger rounded-pill px-3">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="badge bg-success rounded-pill px-3">Tidak ada</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDenda{{ $item->id }}">
                                    <i class="bi bi-pencil-square me-1"></i>Set Denda
                                </button>
                            </td>
                        </tr>

                        {{-- MODAL SET DENDA --}}
                        <div class="modal fade" id="modalDenda{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title fw-bold">
                                            <i class="bi bi-cash-coin me-2"></i>Set Denda
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.pengembalian.updateDenda', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">

                                            {{-- Info Buku --}}
                                            <div class="alert alert-light border mb-3">
                                                <div class="fw-semibold">{{ optional(optional($item->peminjaman)->alat)->nama_alat ?? '-' }}</div>
                                                <small class="text-muted">
                                                    Peminjam: {{ optional(optional($item->peminjaman)->user)->name ?? '-' }}
                                                </small>
                                            </div>

                                            {{-- Terlambat --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Keterlambatan (hari)</label>
                                                <input type="number"
                                                       name="terlambat"
                                                       class="form-control"
                                                       value="{{ $item->terlambat }}"
                                                       min="0"
                                                       placeholder="0">
                                                <small class="text-muted">Isi 0 jika tidak terlambat</small>
                                            </div>

                                            {{-- Denda --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Denda (Rp)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number"
                                                           name="denda"
                                                           class="form-control"
                                                           value="{{ $item->denda }}"
                                                           min="0"
                                                           placeholder="0">
                                                </div>
                                                <small class="text-muted">Isi 0 jika tidak ada denda</small>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-warning text-white fw-semibold">
                                                <i class="bi bi-save me-1"></i>Simpan Denda
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data pengembalian.
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