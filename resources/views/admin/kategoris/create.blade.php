@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Kategori
            </h4>
            <small class="text-muted">Tambah kategori buku baru</small>
        </div>
        <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-grid me-2"></i>Form Kategori
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.kategoris.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   value="{{ old('nama_kategori') }}"
                                   placeholder="Contoh: Fiksi, Non-Fiksi, Sains..."
                                   required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i>Simpan
                            </button>
                            <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary px-4">
                                <i class="bi bi-x me-1"></i>Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection