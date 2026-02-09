<x-layout>
    <x-slot:title>Tambah Alat Baru</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Alat</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('alat.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_alat" class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat') }}" required>
                    @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" min="1" value="1" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Alat</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>