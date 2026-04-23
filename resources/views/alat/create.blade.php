<x-layout>
    <x-slot:title>Tambah Alat Baru</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Alat</h4>
        </div>

        <div class="card-body">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('alat.store') }}" method="POST">
                @csrf

                {{-- NAMA ALAT --}}
                <div class="mb-3">
                    <label>Nama Alat</label>
                    <input type="text"
                           name="nama_alat"
                           value="{{ old('nama_alat') }}"
                           class="form-control"
                           required>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label>Kategori</label>

                    <select name="kategori_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>

                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- KONDISI --}}
                <div class="mb-3">
                    <label>Kondisi</label>

                    <select name="kondisi" class="form-select">
                        <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                            Baik
                        </option>
                        <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>
                            Rusak
                        </option>
                    </select>
                </div>

                {{-- STOK --}}
                <div class="mb-3">
                    <label>Stok</label>

                    <input type="number"
                           name="stok"
                           value="{{ old('stok', 1) }}"
                           class="form-control"
                           min="0"
                           required>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('alat.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-layout>