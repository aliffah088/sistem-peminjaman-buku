@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3>Edit Alat</h3>

    <form action="{{ route('admin.alat.update', $alat->id_alat) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" 
                   value="{{ $alat->nama_alat }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}"
                        {{ $alat->id_kategori == $k->id_kategori ? 'selected' : '' }}>
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