@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Alat</h3>

    <form action="{{ route('admin.alat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}">
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