<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: #f4f7f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 450px;
        }
        .btn-primary {
            background: #4a90e2;
            border: none;
            padding: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: #3a7bc8;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #555;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4a90e2;
        }
    </style>
</head>
<body>

    <div class="card p-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Buat Akun Baru</h4>
            <p class="text-muted small">Silakan lengkapi data di bawah ini</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Daftar Sebagai</label>
                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required onchange="toggleKelas(this.value)">
                    <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>Siswa (Peminjam)</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Petugas (Admin)</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" placeholder="contoh@email.com" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3" id="kelas_container">
                <label class="form-label">Kelas & Jurusan</label>
                <input type="text" id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" 
                       value="{{ old('kelas') }}" placeholder="Contoh: XII RPL 1">
                @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="••••••••" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Konfirmasi</label>
                    <input type="password" name="password_confirmation" class="form-control" 
                           placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">
                <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
            </button>

            <div class="text-center mt-4">
                <small class="text-muted">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>
                </small>
            </div>
        </form>
    </div>

    <script>
        function toggleKelas(role) {
            const container = document.getElementById('kelas_container');
            const input = document.getElementById('kelas');
            
            if (role === 'admin') {
                container.style.display = 'none';
                input.value = ''; 
                input.removeAttribute('required');
            } else {
                container.style.display = 'block';
                input.setAttribute('required', 'required');
            }
        }

        // Jalankan saat load untuk cek kondisi awal
        window.onload = function() {
            toggleKelas(document.getElementById('role').value);
        };
    </script>

</body>
</html>