<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 380px;
        }
        .btn-primary {
            background: #4a90e2;
            border: none;
        }
        .btn-primary:hover {
            background: #3a7bc8;
        }
    </style>
</head>
<body>

    <div class="card p-4">

        {{-- JUDUL --}}
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Selamat Datang Di Sistem Peminjaman Buku</h4>
            <small class="text-muted">Masuk ke akun Anda</small>
        </div>

        {{-- ERROR --}}
        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger py-2 small">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-semibold">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="contoh@email.com" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small text-decoration-none">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>

        </form>

        {{-- REGISTER --}}
        @if(Route::has('register'))
            <div class="text-center mt-3">
                <small class="text-muted">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a>
                </small>
            </div>
        @endif

    </div>

</body>
</html>