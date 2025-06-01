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
                <!-- Bagian Like -->
                <div class="d-flex align-items-center mb-4">
                    <form id="like-form" data-liked="{{ $menu->likedByUser() ? '1' : '0' }}">
                        @csrf
                        <button type="button" id="like-button" class="btn btn-outline-danger me-2">
                            {{-- ❤️ <span id="like-text">{{ $menu->likedByUser() ? 'Disukai' : 'Sukai' }}</span> --}}
                        </button>
                    </form>
                    <span>{{ $menu->likes()->count() }} orang menyukai ini</span>
                </div>

                <!-- Komentar -->
                <div class="mb-5">
                    <h5>Komentar</h5>

                    @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="mb-2">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Tulis komentar Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </form>
                    @else
                    <p><a href="{{ route('login') }}">Login</a> untuk mengomentari.</p>
                    @endauth

                    @foreach ($menu->comments as $comment)
                        <div class="border rounded p-2 mb-2">
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                            @if (auth()->check() && session('edit_comment_id') == $comment->id)
                                <!-- Form edit komentar -->
                                <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <textarea name="comment" class="form-control mb-2" rows="2">{{ old('comment', $comment->comment) }}</textarea>
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                        <a href="{{ url()->current() }}" class="btn btn-sm btn-secondary">Batal</a>
                                    </div>
                                </form>
                            @else
                                <p class="mb-1">{{ $comment->comment }}</p>

                                @if (auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger btn-sm p-0">Hapus</button>
                                    </form>
                                    <a href="{{ url()->current() }}?edit_comment_id={{ $comment->id }}" class="btn btn-link text-primary btn-sm p-0">Edit</a>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('include.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
