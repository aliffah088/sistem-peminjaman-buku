@extends('petugas.layouts.app')

@section('content')
<div class="container mt-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">♻️ Data Pengembalian Alat</h3>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">

                    <!-- HEADER -->
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th class="text-start">Peminjam</th>
                            <th class="text-start">Alat</th>
                            <th>Tgl Pinjam</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                        @forelse ($peminjamans as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- USER -->
                            <td class="text-start">
                                👤 {{ $p->user->name ?? '-' }}
                            </td>

                            <!-- ✅ ALAT FIX -->
                            <td class="text-start">
                                📦 {{ $p->nama_alat ?? '-' }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}
                            </td>

                            <!-- STATUS -->
                            <td>
                                @if($p->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark px-3 py-2">Dipinjam</span>
                                @else
                                    <span class="badge bg-success px-3 py-2">Dikembalikan</span>
                                @endif
                            </td>

                            <!-- DENDA -->
                            <td>
                                @if($p->pengembalian && $p->pengembalian->denda)
                                    <span class="text-danger fw-semibold">
                                        Rp {{ number_format($p->pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td>
                                @if($p->status == 'dipinjam')

                                    <button class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalKembali{{ $p->id }}">
                                        ✔ Proses
                                    </button>

                                    <!-- MODAL -->
                                    <div class="modal fade" id="modalKembali{{ $p->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">

                                                <form action="{{ route('petugas.pengembalian.store') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="id_peminjaman" value="{{ $p->id }}">
                                                    <input type="hidden" name="user_id" value="{{ $p->user_id }}">

                                                    <!-- HEADER -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Konfirmasi Pengembalian</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- BODY -->
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <small class="text-muted">Peminjam</small><br>
                                                            <b>{{ $p->user->name ?? '-' }}</b>
                                                        </div>

                                                        <div class="mb-3">
                                                            <small class="text-muted">Alat</small><br>
                                                            <!-- ✅ FIX DI SINI -->
                                                            <b>{{ $p->nama_alat ?? '-' }}</b>
                                                        </div>

                                                        <hr>

                                                        <!-- KONDISI -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Kondisi Alat</label>
                                                            <select name="kondisi" class="form-select" required>
                                                                <option value="baik">Baik</option>
                                                                <option value="rusak">Rusak</option>
                                                                <option value="hilang">Hilang</option>
                                                            </select>
                                                        </div>

                                                        <!-- DENDA -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Denda (Rp)</label>
                                                            <input type="number" name="denda" class="form-control" placeholder="Opsional">
                                                        </div>

                                                        <!-- STATUS BAYAR -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Status Pembayaran</label>
                                                            <select name="status_denda" class="form-select">
                                                                <option value="belum">Belum Dibayar</option>
                                                                <option value="sudah">Sudah Dibayar</option>
                                                            </select>
                                                        </div>

                                                        <!-- CATATAN -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Keterangan</label>
                                                            <textarea name="keterangan" class="form-control" rows="3"></textarea>
                                                        </div>

                                                    </div>

                                                    <!-- FOOTER -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <span class="text-success fw-bold">✅ Selesai</span>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data pengembalian
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