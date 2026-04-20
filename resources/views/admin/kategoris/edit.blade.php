<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .container {
            width: 500px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h3 {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')

<div class="container">
    <h3>Edit Kategori</h3>

    <form action="{{ route('admin.kategoris.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kategori</label>
        <input type="text" 
               name="nama_kategori"
               value="{{ $kategori->nama_kategori }}"
               required>

        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
