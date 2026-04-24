@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-people me-2 text-primary"></i>Data Users
            </h4>
            <small class="text-muted">Kelola seluruh pengguna sistem</small>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold text-dark">
                <i class="bi bi-table me-2 text-primary"></i>Daftar User
            </span>
            <span class="badge bg-primary rounded-pill">
                {{ $users->count() }} user
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 60px;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td class="ps-4 text-muted">{{ $key + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                         style="width: 38px; height: 38px; min-width: 38px; font-size: 0.85rem;
                                         background-color: {{ $user->role == 'admin' ? '#0d6efd' : ($user->role == 'petugas' ? '#198754' : '#0dcaf0') }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td class="text-center">
                                @if($user->role == 'admin')
                                    <span class="badge bg-primary rounded-pill px-3">Admin</span>
                                @elseif($user->role == 'petugas')
                                    <span class="badge bg-success rounded-pill px-3">Petugas</span>
                                @else
                                    <span class="badge bg-info rounded-pill px-3">Peminjam</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn btn-warning btn-sm text-white me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus user {{ $user->name }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada user.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection