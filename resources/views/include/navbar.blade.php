{{-- Floating Navbar --}}
<nav class="navbar navbar-expand-lg floating-navbar">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-warning" href="{{ url('/home') }}">
            🍳 Dapur <span class="text-danger">Indonesia</span>
        </a>

        <!-- Custom Toggler -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <i class="bi bi-list fs-2 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li id="#home" class="nav-item" ><a class="nav-link" href="{{ url('/home') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/login-user') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
