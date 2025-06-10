<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - Dapur Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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

        .section-title {
            font-family: 'Pacifico', cursive;
            font-size: 2.5rem;
        }
    </style>
</head>
<body>
@include('include.navbar')

{{-- About Content --}}
<section class="container my-5 pt-5">
    <div class="text-center mt-5 pt-5">
        <h1 class="section-title text-warning">Tentang Kami</h1>
        <p class="text-muted lead">Mengenal lebih dekat Dapur Indonesia</p>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <img src="{{ asset('image/labuanbajo.jpg') }}" alt="Tentang Kami" class="img-fluid rounded-4 shadow-sm">
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold text-danger">Dapur Indonesia</h3>
            <p class="text-muted">
                Dapur Indonesia adalah platform digital yang menghadirkan koleksi resep-resep autentik dari seluruh penjuru nusantara.
                Kami percaya bahwa makanan bukan hanya sekadar kebutuhan, tetapi juga budaya, warisan, dan cerita yang menyatukan bangsa.
            </p>
            <p class="text-muted">
                Kami hadir untuk menginspirasi semua kalangan, mulai dari pemula hingga chef profesional, untuk menjelajahi, menciptakan,
                dan membagikan pengalaman kuliner mereka. Dapur Indonesia adalah tempat bertemunya para pecinta masakan Indonesia.
            </p>
            <p class="text-muted">
                Bersama-sama, mari kita lestarikan dan kenalkan kekayaan kuliner Indonesia ke seluruh dunia.
            </p>
        </div>
    </div>
</section>

{{-- Footer --}}
@include('include.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
