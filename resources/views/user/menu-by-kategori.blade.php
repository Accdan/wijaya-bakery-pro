<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep: {{ $kategori->nama_kategori }}</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
        }

        .custom-card {
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    @include('include.navbarUser')

    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Resep pada Kategori: {{ $kategori->nama_kategori }}</h2>

        <div class="row g-4">
            @forelse ($kategori->menus as $menu)
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 custom-card">
                    <img src="{{ asset('uploads/menu/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $menu->title }}</h5>
                        <p class="card-text text-truncate">{{ $menu->desc }}</p>
                        <a href="{{ route('users.kategori.detail', $item->id) }}" class="btn btn-outline-warning mt-3">Lihat Resep</a>
                            Lihat Detail Resep
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada resep dalam kategori ini.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/kategori') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Semua Kategori
            </a>
        </div>
    </div>

    @include('include.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
