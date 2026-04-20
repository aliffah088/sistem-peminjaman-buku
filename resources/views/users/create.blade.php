@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Tambah User</h3>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nama" class="form-control mb-2" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>

        <select name="role" class="form-control mb-2">
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="peminjam">Peminjam</option>
        </select>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>

@endsection