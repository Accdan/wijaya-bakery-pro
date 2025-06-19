<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wijaya Bakery</title>
  <link rel="icon" href="{{ asset('image/logo.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #fff9f5;
      color: #3c2f2f;
    }

    h1, h2, h3, h4 {
      font-family: 'Pacifico', cursive;
    }

    .hero {
      background: url('{{ $hero && $hero->gambar ? asset("uploads/hero/" . $hero->gambar) : asset("images/hero-bg1.jpeg") }}') no-repeat center center/cover;
      height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 1rem;
    }

    .hero h1 {
      font-size: 5rem;
      align-self: flex-start;
      margin-left: 5%;
    }

    .about-us, .promo, .footer {
      background-color: #fef1e6;
    }

    .section-title {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .card-img-top {
      object-fit: cover;
      height: 200px;
    }

    .whatsapp-float {
      position: fixed;
      bottom: 10px;
      right: 15px;
      z-index: 999;
      width: 250px;
      height: 300px;
    }


    .whatsapp-float img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
    }

    /* Scroll target padding (biar gak ketutup navbar) */
    section[id] {
      scroll-margin-top: 100px;
    }

    nav {
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 1000;
    }
    .rotate-box {
      transition: transform 0.6s ease-in-out;
      animation: rotateBox 10s infinite linear;
    }

    @keyframes rotateBox {
      0%   { transform: rotateY(0); }
      25%  { transform: rotateY(5deg); }
      50%  { transform: rotateY(0); }
      75%  { transform: rotateY(-5deg); }
      100% { transform: rotateY(0); }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand text-danger fw-bold" href="#">Wijaya Bakery</a>
    <div>
      <ul class="navbar-nav ms-auto flex-row">
        <li class="nav-item"><a class="nav-link scroll-link" href="#hero">Home</a></li>
        <li class="nav-item"><a class="nav-link scroll-link" href="#about">Tentang</a></li>
        <li class="nav-item"><a class="nav-link scroll-link" href="#menu">Menu</a></li>
        <li class="nav-item"><a class="nav-link scroll-link" href="#contact">Kontak</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
@php
    $heroImage = $hero && $hero->gambar
        ? asset('uploads/hero/' . $hero->gambar)
        : asset('images/hero-bg1.jpeg');
@endphp

<section id="hero" class="hero text-center" style="background: url('{{ $heroImage }}') no-repeat center center/cover;">
  <div class="container">
    <h1 class="display-3">Selamat Datang di Wijaya Bakery</h1>
    <p class="lead">Roti dan kue terenak se-Malang Raya 🍰</p>
  </div>
</section>


<!-- About Section -->
<section id="about" class="about-us py-5 text-center">
  <div class="container">
    <h2 class="section-title">About us</h2>
    <p class="mb-4">Bergabunglah di dunia rasa, nikmati sensasi dari roti dan kue terbaik.</p>
    <a href="#" class="btn btn-outline-dark">Read More</a>
  </div>
</section>

<!-- Explore More -->
<section id="menu" class="py-5 text-center">
  <div class="container">
    <h2 class="section-title">Explore More</h2>
    <ul class="nav justify-content-center mb-4">
      <li class="nav-item"><a class="nav-link active" href="#">Cake</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Muffins</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Croissant</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Bread</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Toast</a></li>
    </ul>
    <div class="row g-4">
      @forelse ($menus as $menu)
      <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card h-100 border-0 shadow-sm hover-shadow">
                  <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                       class="card-img-top rounded-top"
                       alt="{{ $menu->nama_menu }}"
                       style="height: 230px; object-fit: cover;">
                  <div class="card-body d-flex flex-column">
                      <h5 class="card-title fw-bold text-dark">{{ $menu->nama_menu }}</h5>
                      <p class="card-text text-muted mb-4">{{ \Illuminate\Support\Str::limit($menu->deskripsi_menu, 80) }}</p>
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
  </div>
</section>
{{-- Kontak --}}
@if($promos->where('status', 1)->count())
<section id="promo-grid" class="py-5 text-center bg-light">
  <div class="container">
    <h2 class="section-title">Promo Terbaru</h2>
    <div class="row justify-content-center">
      @foreach($promos->where('status', 1)->take(4) as $index => $promo)
      <div class="col-6 col-md-3 mb-4">
        <div class="promo-box rotate-box">
          <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
               alt="{{ $promo->nama_promo }}"
               class="img-fluid rounded shadow-sm"
               style="height: 200px; width: 100%; object-fit: cover;">
          <p class="mt-2 fw-bold">{{ $promo->nama_promo }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif


<!-- Kontak -->
<section id="contact" class="about-us py-5 text-center">
  <div class="container">
    <h2 class="section-title">Kontak Kami</h2>
    <p>Hubungi kami untuk informasi lebih lanjut.</p>
  </div>
</section>
<!-- Sponsor List -->
@if($sponsors->count())
<section id="sponsors" class="py-5 text-center about-us">
  <div class="container">
    <h2 class="section-title">Sponsor Kami</h2>
    <div class="row justify-content-center g-4">
      @foreach($sponsors as $sponsor)
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card border-0 bg-transparent">
          @if($sponsor->logo_sponsor)
            <img src="{{ asset('uploads/sponsor/' . $sponsor->logo_sponsor) }}" class="img-fluid rounded" alt="{{ $sponsor->nama_sponsor }}">
          @else
            <div class="bg-secondary text-white rounded py-4">No Logo</div>
          @endif
          {{-- <div class="mt-2 small text-muted">{{ $sponsor->nama_sponsor }}</div> --}}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
<!-- Footer -->
<footer class="footer py-4 text-white" style="background-color:#3c2f2f">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3">
        <h5>About Us</h5>
        <p>Telp: (0341) 123-456<br>Alamat: Jl. Roti Manis No.12<br>Email: wijaya@bakery.com</p>
      </div>
      <div class="col-md-4">
        <h5>Recent News</h5>
        <p>- Roti pastry edisi baru<br>- Tart pastry cita rasa unik</p>
      </div>
    </div>
    <div class="text-center mt-3">
      <small>&copy; 2025 Wijaya Bakery. All rights reserved.</small>
    </div>
  </div>
</footer>

<!-- WhatsApp Button -->
<a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float">
  <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" width="50" height="50">
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Smooth Scroll -->
<script>
  document.querySelectorAll('.scroll-link').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth'
          
        });
      }
    });
  });
</script>

</body>
</html>
        