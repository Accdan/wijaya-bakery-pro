<!-- dashboard-user.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard User - Dapur Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fdfdfd;
        }
        .navbar-brand {
            font-family: 'Pacifico', cursive;
            font-size: 1.8rem;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
        }
        .like-btn, .comment-btn {
            cursor: pointer;
            transition: color 0.3s;
        }
        .like-btn.liked {
            color: #ffc107;
        }
        .comments-section {
            max-height: 150px;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
        }
        .btn-warning {
            font-weight: bold;
        }
        .card-text {
            color: #555;
        }
        .modal-content {
            border-radius: 1rem;
        }
        .btn-submit-comment {
            float: right;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Dapur Indonesia</a>
        <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mb-5">
    <h2 class="mb-4 fw-bold text-center">🍽 Menu Masakan Favorit</h2>

    <div class="row g-4">
        @foreach ($menus ?? [] as $menu)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('uploads/menu/' . $menu['image']) }}" class="card-img-top" alt="{{ $menu['title'] }}" style="height: 220px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $menu['title'] }}</h5>
                    <p class="card-text">{{ $menu['desc'] }}</p>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="like-btn" role="button" title="Like">
                                <i class="bi bi-star"></i>
                            </span>
                            <span class="ms-1 like-count">0</span>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-primary comment-btn" data-bs-toggle="collapse" data-bs-target="#comments-{{ $menu['id'] }}">
                                <i class="bi bi-chat-left-text"></i> (0)
                            </button>
                        </div>
                    </div>

                    <button class="btn btn-warning w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-id="{{ $menu['id'] }}"
                        data-title="{{ $menu['title'] }}"
                        data-desc="{{ $menu['desc'] }}"
                        data-image="{{ asset('uploads/menu/' . $menu['image']) }}"
                        data-detail-url="{{ route('menu.detail', $menu['id']) }}">
                        Lihat Detail Resep
                    </button>

                    <div class="collapse mt-3" id="comments-{{ $menu['id'] }}">
                        <div class="comments-section mb-2">
                            @if (!empty($menu['comments']))
                                @foreach ($menu['comments'] as $comment)
                                    <div><strong>{{ $comment['user'] }}:</strong> {{ $comment['text'] }}</div>
                                @endforeach
                            @else
                                <small class="text-muted">Belum ada komentar.</small>
                            @endif
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm comment-input" placeholder="Tulis komentar..." />
                            <button class="btn btn-sm btn-warning btn-submit-comment" data-id="{{ $menu['id'] }}">Kirim</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

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
            <a id="detailLink" href="#" class="btn btn-warning w-100 mt-auto">
                Lihat Lebih Detail
            </a>
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
        document.getElementById('detailLink').href = button.getAttribute('data-detail-url');
    });

    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('liked');
            const icon = btn.querySelector('i');
            const countSpan = btn.nextElementSibling;
            let count = parseInt(countSpan.textContent);
            if (btn.classList.contains('liked')) {
                icon.classList.replace('bi-star', 'bi-star-fill');
                count++;
            } else {
                icon.classList.replace('bi-star-fill', 'bi-star');
                count--;
            }
            countSpan.textContent = count;
        });
    });

    document.querySelectorAll('.btn-submit-comment').forEach(btn => {
        btn.addEventListener('click', () => {
            const menuId = btn.getAttribute('data-id');
            const parent = btn.closest('.collapse');
            const input = parent.querySelector('.comment-input');
            const commentsSection = parent.querySelector('.comments-section');
            const text = input.value.trim();
            if(text === '') return alert('Komentar tidak boleh kosong!');
            const newComment = document.createElement('div');
            newComment.innerHTML = `<strong>Anda:</strong> ${text}`;
            commentsSection.appendChild(newComment);
            input.value = '';

            const commentBtn = parent.previousElementSibling.querySelector('.comment-btn');
            const match = commentBtn.innerText.match(/\((\d+)\)/);
            let current = match ? parseInt(match[1]) : 0;
            commentBtn.innerHTML = `<i class="bi bi-chat-left-text"></i> (${current + 1})`;
        });
    });
</script>

</body>
</html>
