<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Masakan - {{ $menu->nama_menu }}</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fffefc;
        }
        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
        }
        .menu-image {
            max-height: 400px;
            object-fit: cover;
            border-radius: 1rem;
        }
        .card {
            border-radius: 1rem;
        }
        .menu-image {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            border-radius: 1rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Dapur Indonesia</a>
        <a href="{{ route('dashboard.user') }}" class="btn btn-outline-secondary btn-sm">⬅ Kembali ke Dashboard</a>
    </div>
</nav>

<div class="container mb-5">
    <div class="card p-4 shadow-sm">
        <div class="row g-4 align-items-start">
            <!-- Kolom kiri: teks -->
            <div class="col-md-6">
                <h2 class="mb-3 fw-bold">{{ $menu->nama_menu }}</h2>

                @if($menu->kategori)
                <p>
                    <span class="badge bg-secondary">{{ $menu->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                </p>
                @endif

                <h5>Deskripsi:</h5>
                <p class="fs-5">{{ $menu->deskripsi_menu }}</p>

                @if (!empty($menu->prosedur))
                    <hr>
                    <h5>Langkah Pembuatan:</h5>
                    <ol>
                        @foreach (explode("\n", $menu->prosedur) as $langkah)
                            <li>{{ $langkah }}</li>
                        @endforeach
                    </ol>
                @endif
            </div>

            <!-- Kolom kanan: gambar -->
            <div class="col-md-6">
                <img src="{{ asset('uploads/menu/' . $menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}" class="img-fluid menu-image mx-auto d-block">
            </div>
        </div>
    </div>
</div>

@include('include.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
