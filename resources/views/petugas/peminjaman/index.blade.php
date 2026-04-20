@extends('petugas.layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">📦 Data Peminjaman</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Tanggal Pinjam</th>
                            <th>Rencana Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjamans as $p)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $p->nama_peminjam ?? '-' }}</td>

                            <td>{{ $p->nama_alat ?? '-' }}</td>

                            <td>
                                {{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') : '-' }}
                            </td>

                            <td>
                                {{ $p->tgl_rencana_kembali ? \Carbon\Carbon::parse($p->tgl_rencana_kembali)->format('d/m/Y') : '-' }}
                            </td>

                            <td>
                                @if($p->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($p->status == 'dipinjam')
                                    <span class="badge bg-info">Dipinjam</span>
                                @elseif($p->status == 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @elseif($p->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-dark">-</span>
                                @endif
                            </td>

                            <td class="text-center">

                                {{-- MENUNGGU --}}
                                @if($p->status == 'menunggu')

                                    <form action="{{ route('petugas.peminjaman.update', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dipinjam">
                                        <button class="btn btn-success btn-sm">✔ Setujui</button>
                                    </form>

                                    <form action="{{ route('petugas.peminjaman.update', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button class="btn btn-danger btn-sm">✖ Tolak</button>
                                    </form>

                                {{-- DIPINJAM --}}
                                @elseif($p->status == 'dipinjam')

                                    <form action="{{ route('petugas.peminjaman.update', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dikembalikan">
                                        <button class="btn btn-warning btn-sm">↩ Kembalikan</button>
                                    </form>

                                @else
                                    <span class="text-muted small">-</span>
                                @endif

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Belum ada data peminjaman
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