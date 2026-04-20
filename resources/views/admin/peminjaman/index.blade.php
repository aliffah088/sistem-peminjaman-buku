@extends('admin.layouts.app')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Peminjaman</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div> 
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada data peminjaman.
                    </td>
   mnn             </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
