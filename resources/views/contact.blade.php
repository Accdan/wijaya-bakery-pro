<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak | Dapur Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
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
    </style>
</head>
<body>

{{-- Navbar --}}
@include('include.navbar')

{{-- Konten Utama --}}
<section class="container pt-5 mt-5 pb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold display-5">Hubungi Kami</h2>
        <p class="text-muted">Kami senang mendengar dari Anda! Silakan hubungi kami melalui form berikut atau informasi kontak yang tersedia.</p>
    </div>

    <div class="row g-4">
        {{-- Form Kontak --}}
        <div class="col-md-7">
            <div class="p-4 rounded-4 shadow-sm bg-light">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Pesan</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning fw-semibold w-100">Kirim Pesan</button>
                </form>
            </div>
        </div>

        {{-- Info Kontak --}}
        <div class="col-md-5">
            <div class="p-4 rounded-4 shadow-sm bg-warning-subtle h-100">
                <h4 class="fw-bold text-warning">Informasi Kontak</h4>
                <p class="text-muted">Jika Anda memiliki pertanyaan atau saran, silakan hubungi kami melalui informasi berikut:</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="bi bi-envelope-fill me-2"></i> support@dapurindonesia.id</li>
                    <li><i class="bi bi-telephone-fill me-2"></i> +62 812-3456-7890</li>
                    <li><i class="bi bi-geo-alt-fill me-2"></i> Surabaya, Indonesia</li>
                </ul>
                <p class="text-muted mt-4">Ikuti kami di media sosial:</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-danger fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-primary fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-info fs-4"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
@include('include.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
