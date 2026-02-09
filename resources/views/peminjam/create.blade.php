<x-layout>
    <x-slot:title>Pinjam Alat</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Peminjaman Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Alat yang Tersedia</label>
                    <select name="id_alat" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach ($alats as $a)
                            <option value="{{ $a->id_alat }}">{{ $a->nama_alat }} (Stok: {{ $a->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Pinjam</label>
                    <input type="number" name="jumlah_pinjam" class="form-control" min="1" value="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pengembalian</label>
                    <input type="date" name="tgl_kembali" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Konfirmasi Pinjam</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>