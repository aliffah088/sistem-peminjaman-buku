@extends('admin.layouts.app')

@section('content')
<h3>Edit User</h3>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ $user->role=='petugas' ? 'selected' : '' }}>Petugas</option>
            <option value="peminjam" {{ $user->role=='peminjam' ? 'selected' : '' }}>Peminjam</option>
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
