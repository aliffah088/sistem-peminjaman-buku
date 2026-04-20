<!DOCTYPE html>
<html>
<head>
    <title>Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    {{-- Sidebar --}}
    @include('peminjam.layouts.sidebar')

    {{-- Content --}}
    <div class="p-4" style="width: 100%;">
        @yield('content')
    </div>

</div>

</body>
</html>