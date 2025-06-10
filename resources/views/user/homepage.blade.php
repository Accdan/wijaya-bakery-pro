<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
        }

        .carousel-caption h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
        }

        .hover-shadow {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .floating-navbar {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            border-radius: 20px;
            padding: 0.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1050;
            width: auto;
            max-width: 90%;
        }

        .navbar {
            background: #ffffff;
            border: none !important;
        }

        .vh-100 {
            height: 100vh;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .custom-card {
            background-color: #f9f9f9;
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

                .carousel-minimalist {
            height: 50vh; /* set tinggi carousel jadi setengah layar */
            max-height: 400px; /* batas maksimal tinggi */
            min-height: 300px; /* batas minimal tinggi */
            position: relative;
        }

        .carousel-minimalist .carousel-caption {
            bottom: 1rem;
            text-shadow: none;
            background: rgba(255, 255, 255, 0.7); /* background putih transparan */
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: #333;
            max-width: 60%;
        }

        .carousel-minimalist .carousel-caption h1 {
            font-size: 1.5rem;
            font-weight: 700;
            font-family: 'Pacifico', cursive;
        }

        .carousel-minimalist .carousel-caption p {
            font-size: 0.9rem;
            margin: 0;
        }

    </style>
</head>
<body>

    @include('include.navbarUser')

    <!-- Hero Carousel -->
    <section class="carousel-wrapper py-3 px-2">
        <div id="carouselExample" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100 rounded-4 overflow-hidden shadow">
                @foreach ([
                    ['image' => 'slide1.jpg', 'title' => 'Selamat Datang di Dapur Indonesia', 'desc' => 'Temukan berbagai resep nusantara yang menggoda selera'],
                    ['image' => 'slide2.jpg', 'title' => 'Resep Masakan Nusantara', 'desc' => 'Setiap masakan membawa cerita dan kenangan'],
                    ['image' => 'slide3.jpg', 'title' => 'Inspirasi Dapur Anda', 'desc' => 'Resep inovatif untuk semua kesempatan'],
                ] as $index => $slide)
                    <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('image/' . $slide['image']) }}" 
                             class="d-block w-100 h-100 object-fit-cover" 
                             alt="Slide {{ $index + 1 }}">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 px-3 py-2">
                            <h1 class="fw-bold">{{ $slide['title'] }}</h1>
                            <p>{{ $slide['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        </div>
    </section>
F    

    <div class="container my-5">
        <div class="row g-4 text-center">
            @foreach([
                ['icon' => 'fas fa-user', 'title' => 'Profil Saya', 'btn' => 'Lihat', 'url' => '#'],
                ['icon' => 'fas fa-shopping-basket', 'title' => 'Pesanan', 'btn' => 'Lihat', 'url' => '#'],
                ['icon' => 'fas fa-bell', 'title' => 'Notifikasi', 'btn' => 'Cek', 'url' => '#'],
                ['icon' => 'fas fa-plus-circle', 'title' => 'Ajukan Resep', 'btn' => 'Buat', 'url' => '#'],
            ] as $card)
                <div class="col-md-6 col-lg-3">
                    <div class="card custom-card h-100 text-center shadow-sm border-0 hover-shadow">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                            <i class="{{ $card['icon'] }} text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="fw-semibold mb-3">{{ $card['title'] }}</h5>
                            <a href="{{ $card['url'] }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-auto">{{ $card['btn'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('include.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('detailTitle').textContent = button.getAttribute('data-title');
            document.getElementById('detailDesc').textContent = button.getAttribute('data-desc');
            document.getElementById('detailImage').src = button.getAttribute('data-image');
            document.getElementById('detailImage').alt = button.getAttribute('data-title');
        });
    </script>
</body>
</html>
