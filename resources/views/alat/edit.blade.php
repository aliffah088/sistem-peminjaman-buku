<x-layout>
    <x-slot:title>Edit Alat</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0 text-dark">Edit Data: {{ $alat->nama_alat }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('alat.update', $alat->id_alat) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_alat" class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control" value="{{ $alat->nama_alat }}" required>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ $alat->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select">
                        <option value="baik" {{ $alat->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ $alat->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $alat->stok }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>