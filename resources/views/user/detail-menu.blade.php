<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Masakan - {{ $menu->nama_menu }}</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #fffefc;
            color: #333;
            min-height: 100vh;
        }
        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
        }
        .menu-image {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
        }
        h2, h5 {
            color: #3a3a3a;
        }
        .badge-secondary {
            background-color: #6c757d;
            font-weight: 600;
        }
        ol li {
            margin-bottom: 0.6rem;
        }
        /* Like button */
        #like-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        #like-button.liked {
            color: #dc3545;
            border-color: #dc3545;
            background-color: #f8d7da;
        }
        #like-button:hover {
            background-color: #f5f5f5;
        }
        /* Comments */
        .comment {
            border: 1px solid #ddd;
            border-radius: 0.6rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #fff;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.05);
        }
        .comment strong {
            font-weight: 700;
        }
        .comment small {
            color: #888;
            font-size: 0.85rem;
        }
        .comment-actions button,
        .comment-actions a {
            font-size: 0.85rem;
            padding: 0;
            margin-left: 1rem;
        }
        .comment-actions {
            margin-top: 0.5rem;
        }
        textarea.form-control {
            resize: vertical;
        }
        @media (max-width: 767px) {
            .row.g-4 {
                flex-direction: column;
            }
            .col-md-6 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Dapur Indonesia</a>
        <a href="{{ url('/dashboard-user') }}" class="btn btn-outline-secondary btn-sm">
            ⬅ Kembali ke Dashboard
        </a>
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

                <h5 class="mt-4">Deskripsi:</h5>
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

            <!-- Kolom kanan: gambar + like + komentar -->
            <div class="col-md-6">
                <img src="{{ asset('uploads/menu/' . $menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}" class="img-fluid menu-image mx-auto d-block mb-4">

                <!-- Bagian Like -->
                <div class="d-flex align-items-center mb-4">
                    <form id="like-form" data-liked="{{ $menu->likedByUser() ? '1' : '0' }}">
                        @csrf
                        <button type="button" id="like-button" class="btn btn-outline-danger me-3 {{ $menu->likedByUser() ? 'liked' : '' }}">
                            ❤️ <span id="like-text">{{ $menu->likedByUser() ? 'Disukai' : 'Sukai' }}</span>
                        </button>
                    </form>
                    <span class="fw-semibold">{{ $menu->likes()->count() }} orang menyukai ini</span>
                </div>

                <!-- Komentar -->
                <div>
                    <h5>Komentar</h5>

                    @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <textarea name="comment" class="form-control mb-2" rows="3" placeholder="Tulis komentar Anda..."></textarea>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </form>
                    @else
                    <p><a href="{{ route('login-user') }}">Login</a> untuk mengomentari.</p>
                    @endauth

                    @foreach ($menu->comments as $comment)
                        <div class="comment">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>

                            @if (auth()->check() && session('edit_comment_id') == $comment->id)
                                <!-- Form edit komentar -->
                                <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-2">
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
                                    <div class="comment-actions">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">Hapus</button>
                                        </form>
                                        <a href="{{ url()->current() }}?edit_comment_id={{ $comment->id }}" class="btn btn-link text-primary p-0">Edit</a>
                                    </div>
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

<script>
    // Contoh toggle class liked pada tombol like saat diklik (perlu dihubungkan dengan backend ajax supaya tersimpan)
    document.getElementById('like-button').addEventListener('click', function() {
        const btn = this;
        const form = document.getElementById('like-form');
        const liked = form.getAttribute('data-liked') === '1';
        if (liked) {
            btn.classList.remove('liked');
            btn.querySelector('#like-text').textContent = 'Sukai';
            form.setAttribute('data-liked', '0');
        } else {
            btn.classList.add('liked');
            btn.querySelector('#like-text').textContent = 'Disukai';
            form.setAttribute('data-liked', '1');
        }
        // TODO: kirim ajax ke server untuk update status like
    });
</script>

</body>
</html>
