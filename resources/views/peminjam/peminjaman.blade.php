@extends('peminjam.layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Peminjaman Saya</h3>

    {{-- NOTIF SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- NOTIF VALIDASI ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM PINJAM --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Pinjam Alat</div>
        <div class="card-body">

            <form action="{{ route('peminjam.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pilih Alat</label>

                    <select name="id_alat" class="form-control @error('id_alat') is-invalid @enderror" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($alat as $a)
                            <option value="{{ $a->id_alat }}">
                                {{ $a->nama_alat }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_alat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Rencana Kembali</label>
                    <input
                        type="date"
                        name="tgl_rencana_kembali"
                        class="form-control @error('tgl_rencana_kembali') is-invalid @enderror"
                        min="{{ date('Y-m-d') }}"
                        required
                    >
                    @error('tgl_rencana_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Pinjam
                </button>

            </form>

        </div>
    </div>

    {{-- DATA PEMINJAMAN --}}
    <div class="card">
        <div class="card-header fw-bold">Data Peminjaman</div>
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- ✅ FIX DISINI --}}
                        <td>{{ $p->nama_alat }}</td>

                        <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_rencana_kembali)->format('d/m/Y') }}</td>

                        <td>
                            @if($p->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($p->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($p->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif($p->status == 'dikembalikan')
                                <span class="badge bg-primary">Dikembalikan</span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection