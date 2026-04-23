@extends('peminjam.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-1">📋 Peminjaman Buku</h2>
    <p class="text-secondary mb-4">Form peminjaman buku perpustakaan.</p>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form di tengah --}}
    <div class="d-flex justify-content-center">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                <h6 class="mb-0 fw-semibold">
                    <i class="bi bi-clipboard-plus me-2"></i>Pinjam Buku
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('peminjam.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Buku</label>
                        <select name="alat_id"
                                class="form-select @error('alat_id') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($alats as $a)
                                <option value="{{ $a->id }}" {{ old('alat_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama_alat }} (Stok: {{ $a->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('alat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tanggal Rencana Kembali</label>
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

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i>Pinjam Sekarang
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection