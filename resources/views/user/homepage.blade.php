<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard - Dapur Indonesia</title>
    <link rel="icon" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }

        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
            color: #2c3e50 !important;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #555;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #2c3e50;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('image/header-dapur.jpg') }}') no-repeat center center / cover;
            height: 350px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3.2rem;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .card {
            border: none;
            border-radius: 16px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .card i {
            font-size: 2.4rem;
            color: #2c3e50;
        }

        .btn-custom {
            background-color: #2c3e50;
            color: #fff;
            border-radius: 25px;
            padding: 6px 24px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn-custom:hover {
            background-color: #1a252f;
        }

        footer {
            background-color: #ffffff;
            font-size: 0.9rem;
            color: #666;
            border-top: 1px solid #ddd;
        }

        @media (max-width: 767.98px) {
            .hero h1 {
                font-size: 2.3rem;
            }

            .card i {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Dapur Indonesia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home me-1"></i>Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard-user') }}"><i class="fas fa-home me-1"></i>Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user me-1"></i>Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-shopping-basket me-1"></i>Pesanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-plus-circle me-1"></i>Resep</a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger ms-2"><i class="fas fa-sign-out-alt me-1"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Hero Section with Carousel Background and Arrows --}}
<section class="hero position-relative overflow-hidden" style="height: 350px;">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100" style="background: url('{{ asset('image/slide1.jpg') }}') center/cover no-repeat;">
            </div>
            <div class="carousel-item h-100" style="background: url('{{ asset('image/slide2.jpg') }}') center/cover no-repeat;">
            </div>
            <div class="carousel-item h-100" style="background: url('{{ asset('image/slide3.jpg') }}') center/cover no-repeat;">
            </div>
        </div>

        {{-- Panah navigasi kiri --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        {{-- Panah navigasi kanan --}}
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-3" style="z-index: 10;">
        <h1 style="font-family: 'Pacifico', cursive; font-size: 3.2rem; text-shadow: 0 0 10px rgba(0,0,0,0.7);">
            Selamat Datang di Dapur Indonesia
        </h1>
        <p class="lead" style="text-shadow: 0 0 8px rgba(0,0,0,0.6);">
            Temukan dan bagikan resep masakan Nusantara favoritmu!
        </p>
    </div>

    {{-- Carousel indicators --}}
    <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x mb-3">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
</section>

<div class="container my-5">
    <div class="row g-4 text-center">
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm p-4 rounded-3 border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-user mb-3 text-primary" style="font-size: 3rem;"></i>
                <h5 class="fw-semibold mb-3">Profil Saya</h5>
                <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill mt-auto">Lihat</a>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm p-4 rounded-3 border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-shopping-basket mb-3 text-primary" style="font-size: 3rem;"></i>
                <h5 class="fw-semibold mb-3">Pesanan</h5>
                <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill mt-auto">Lihat</a>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm p-4 rounded-3 border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-bell mb-3 text-primary" style="font-size: 3rem;"></i>
                <h5 class="fw-semibold mb-3">Notifikasi</h5>
                <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill mt-auto">Cek</a>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm p-4 rounded-3 border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-plus-circle mb-3 text-primary" style="font-size: 3rem;"></i>
                <h5 class="fw-semibold mb-3">Ajukan Resep</h5>
                <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill mt-auto">Buat</a>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="text-center py-4">
    <p class="mb-0">&copy; {{ date('Y') }} <strong>Dapur Indonesia</strong>. Dibuat dengan cinta kuliner.</p>
</footer>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 4000,
            ride: 'carousel',
            pause: false,
            wrap: true
        });
    });
</script>
</body>
</html>
