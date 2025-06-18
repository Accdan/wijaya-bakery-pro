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
            background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center/cover;
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
            font-size: 5rem; /* lebih besar */
            align-self: flex-start; /* geser ke kiri */
            margin-left: 5%; /* beri jarak dari sisi kiri */
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

        /* WhatsApp Button Style */
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

        /* @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); } */
        /* } */
    </style>
</head>
<body>

    <section class="hero" style="background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center/cover;">
        <h1>Wijaya Bakery</h1>
        {{-- <a href="https://wa.me/6281234567890" class="btn btn-success mt-3"></a> --}}
    </section>

    <!-- About Section -->
    <section class="about-us py-5 text-center">
        <div class="container">
            <h2 class="section-title">About us</h2>
            <p class="mb-4">Bergabunglah di dunia rasa, nikmati sensasi dari roti dan kue terbaik.</p>
            <a href="#" class="btn btn-outline-dark">Read More</a>
        </div>
    </section>

    <!-- Explore More -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="section-title">Explore More</h2>
            <ul class="nav justify-content-center mb-4">
                <li class="nav-item"><a class="nav-link active" href="#">Cake</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Muffins</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Croissant</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Bread</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Toast</a></li>
            </ul>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach (['cake1.jpg', 'cake2.jpg', 'cake3.jpg', 'cake4.jpg', 'cake5.jpg', 'cake6.jpg'] as $image)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('image/' . $image) }}" class="card-img-top" alt="Cake">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section class="promo py-5 text-center">
        <div class="container">
            <h3>20% Off your First Order</h3>
            <p>Dapatkan diskon pertama kali, nikmati kelezatannya.</p>
            <a href="#" class="btn btn-danger">Learn More</a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer py-4 text-white" style="background-color:#3c2f2f">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p>Telp: (0341) 123-456<br>Alamat: Jl. Roti Manis No.12<br>Email: wijaya@bakery.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Explore</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Menu</a></li>
                        <li><a href="#" class="text-white">Promo</a></li>
                        <li><a href="#" class="text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-white">Kontak</a></li>
                    </ul>
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

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float">
        <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" width="50" height="50">
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
