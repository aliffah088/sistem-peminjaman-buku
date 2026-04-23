<x-layout>
    <x-slot:title>Pinjam Alat</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Peminjaman Baru</h5>
        </div>
        <div class="card-body">

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Alat yang Tersedia</label>
                    <select name="alat_id" class="form-select @error('alat_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach ($alats as $a)
                            <option value="{{ $a->id }}" {{ old('alat_id') == $a->id ? 'selected' : '' }}>
                                {{ $a->nama_alat }} (Stok: {{ $a->stok }})
                            </option>
                        @endforeach
                    </select>
                    @error('alat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Rencana Kembali</label>
                    <input type="date"
                           name="tgl_rencana_kembali"
                           class="form-control @error('tgl_rencana_kembali') is-invalid @enderror"
                           value="{{ old('tgl_rencana_kembali') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           required>
                    @error('tgl_rencana_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Konfirmasi Pinjam</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>