<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            width: 500px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')

<div class="container">

    <h3>Edit Kategori</h3>

    <form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>

        <label>Deskripsi</label>
        <input type="text" name="deskripsi" value="{{ $kategori->deskripsi }}">

        <button type="submit">Update</button>
    </form>

</div>

</body>
</html>