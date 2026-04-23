<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    {{-- Brand --}}
    <a class="navbar-brand ps-3 fw-bold" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-book me-2"></i>Perpustakaan
    </a>

    {{-- Sidebar Toggle --}}
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="bi bi-list text-white fs-5"></i>
    </button>

    {{-- Search --}}
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Cari..." />
            <button class="btn btn-primary" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    {{-- User Dropdown --}}
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-5"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <span class="dropdown-item-text text-muted small">
                        {{ auth()->user()->name }}
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>

</nav>