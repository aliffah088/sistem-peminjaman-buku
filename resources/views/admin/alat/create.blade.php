@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Buku</h3>

    <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Cover Buku</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Format: jpeg, png, jpg, gif, webp (max 2MB)</small>
        </div>

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="nama_alat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" placeholder="Nama penulis buku">
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit">
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" min="1900" max="2100">
        </div>

        <div class="mb-3">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="Nomor ISBN (opsional)">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kondisi</label>
            <select name="kondisi" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection