<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; scroll-behavior: smooth; }
        .navbar-brand { font-family: 'Pacifico', cursive; font-size: 1.8rem; }
        .carousel-caption h1 { font-family: 'Pacifico', cursive; font-size: 3rem; }
        .hover-shadow {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    @include('include.navbar')

    <!-- Hero Carousel -->
    <section class="vh-100">
        <div id="carouselExample" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                @foreach ([
                    ['image' => 'hero-bg.jpg', 'title' => 'Selamat Datang di Dapur Indonesia', 'desc' => 'Temukan berbagai resep nusantara yang menggoda selera'],
                    ['image' => 'random1.jpg', 'title' => 'Resep Masakan Nusantara', 'desc' => 'Setiap masakan membawa cerita dan kenangan'],
                    ['image' => 'ampera1.jpg', 'title' => 'Inspirasi Dapur Anda', 'desc' => 'Resep inovatif untuk semua kesempatan'],
                ] as $index => $slide)
                <div class="carousel-item h-100 position-relative {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('image/' . $slide['image']) }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>{{ $slide['title'] }}</h1>
                        <p>{{ $slide['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Menu Pilihan</h2>
            <p class="text-muted">Jelajahi resep khas Indonesia favorit Anda</p>
        </div>
        <div class="row g-4">
            @foreach ([
                ['image' => 'img1.png', 'title' => 'Sate Ayam', 'desc' => 'Resep klasik dengan bumbu kacang khas Indonesia.'],
                ['image' => 'img2.jpg', 'title' => 'Nasi Goreng', 'desc' => 'Masakan rumahan yang mudah dan nikmat.'],
                ['image' => 'img3.jpg', 'title' => 'Rendang', 'desc' => 'Masakan Padang paling terkenal di dunia.'],
            ] as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                    <img src="{{ asset('image/' . $item['image']) }}" class="card-img-top rounded-top" alt="{{ $item['title'] }}" style="height: 230px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $item['title'] }}</h5>
                        <p class="card-text text-muted mb-4">{{ $item['desc'] }}</p>
                        <a href="#" class="btn btn-warning mt-auto w-100 fw-semibold shadow-sm">🍽 Lihat Resep</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Komentar dan Subscribe -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h4>Komentar</h4>
                <textarea class="form-control mb-2" rows="4" placeholder="Tulis komentar Anda..."></textarea>
                <button class="btn btn-warning">Kirim</button>
            </div>
            <div class="col-md-6">
                <h4>Langganan Resep</h4>
                <form class="d-flex mt-3">
                    <input type="email" class="form-control rounded-start" placeholder="Masukkan email Anda" required>
                    <button class="btn btn-warning rounded-end" type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    @include('include.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
