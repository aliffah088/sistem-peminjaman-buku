@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>Edit Buku</h3>

    <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Cover Buku</label>
            @if($alat->gambar)
                <div class="mb-2">
                    <img src="{{ asset($alat->gambar) }}" alt="Cover" style="max-width: 150px; max-height: 200px;">
                </div>
            @endif
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
        </div>

        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="nama_alat" 
                   value="{{ $alat->nama_alat }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Penulis</label>
            <input type="text" name="penulis" 
                   value="{{ $alat->penulis ?? '' }}" 
                   class="form-control" placeholder="Nama penulis">
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="penerbit" 
                   value="{{ $alat->penerbit ?? '' }}" 
                   class="form-control" placeholder="Nama penerbit">
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" 
                   value="{{ $alat->tahun_terbit ?? '' }}" 
                   class="form-control" placeholder="Contoh: 2024" min="1900" max="2100">
        </div>

        <div class="mb-3">
            <label>ISBN</label>
            <input type="text" name="isbn" 
                   value="{{ $alat->isbn ?? '' }}" 
                   class="form-control" placeholder="Nomor ISBN">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}"
                        {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" 
                   value="{{ $alat->stok }}" 
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Kondisi</label>
            <select name="kondisi" class="form-control">
                <option value="baik" {{ $alat->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $alat->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection