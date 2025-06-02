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
    </style>
</head>
<body>

    {{-- Floating Navbar --}}
    <nav class="navbar navbar-expand-lg floating-navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">Dapur Indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <section class="vh-100">
        <div id="carouselExample" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                @foreach ([
                    ['image' => 'hero-bg.jpg', 'title' => 'Selamat Datang di Dapur Indonesia', 'desc' => 'Temukan berbagai resep nusantara yang menggoda selera'],
                    ['image' => 'random1.jpg', 'title' => 'Resep Masakan Nusantara', 'desc' => 'Setiap masakan membawa cerita dan kenangan'],
                    ['image' => 'random2.jpg', 'title' => 'Inspirasi Dapur Anda', 'desc' => 'Resep inovatif untuk semua kesempatan'],
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
            @forelse ($menus as $menu)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                            class="card-img-top rounded-top"
                            alt="{{ $menu->nama_menu }}"
                            style="height: 230px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $menu->nama_menu }}</h5>
                            <p class="card-text text-muted mb-4">{{ \Illuminate\Support\Str::limit($menu->deskripsi_menu, 80) }}</p>
                            <button class="btn btn-warning mt-auto w-100 fw-semibold shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                data-id="{{ $menu->id }}"
                                data-title="{{ $menu->nama_menu }}"
                                data-desc="{{ $menu->deskripsi_menu }}"
                                data-image="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}">
                                🍽 Lihat Detail Resep
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info text-center w-100">
                        Belum ada menu yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Komentar dan Subscribe -->
    <section id="kontak" class="container my-5">
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

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Resep</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <img id="detailImage" src="" alt="" class="img-fluid rounded mb-3" />
                    <h4 id="detailTitle"></h4>
                    <p id="detailDesc"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
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
