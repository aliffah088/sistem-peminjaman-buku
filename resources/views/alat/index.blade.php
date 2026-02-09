<x-layout>
    <x-slot:title>Daftar Alat</x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Data Alat</h3>
        <a href="{{ route('alat.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Alat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th> <th>Kondisi</th>
                    <th>Stok</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alats as $a)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $a->nama_alat }}</td>
                    <td>{{ $a->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                    <td class="text-center">
                        <span class="badge {{ $a->kondisi == 'baik' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($a->kondisi) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $a->stok }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('alat.edit', $a->id_alat) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                            
                            <form action="{{ route('alat.destroy', $a->id_alat) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus alat {{ $a->nama_alat }}?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Data alat masih kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>