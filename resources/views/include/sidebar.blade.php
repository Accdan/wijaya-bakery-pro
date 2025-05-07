<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="#" class="brand-link d-flex justify-content-center align-items-center">
        <img src="{{ asset('image/logo1.png') }}" alt="Logo Resep" class="brand-image" style="max-width: 180px; max-height: 120px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('uploads/profile_pictures/' . session('profile_picture', 'default.png')) }}"
                     class="img-circle elevation-2" alt="User Image" style="width: 45px; height: 45px; object-fit: cover;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold">{{ session('nama_user') }}</a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    {{ session('role_name', 'Unknown') }}
                </span>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Peran Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengguna') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('resep') }}" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Kelola Resep</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('kategori') }}" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Kategori Makanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('bahan') }}" class="nav-link">
                        <i class="nav-icon fas fa-carrot"></i>
                        <p>Bahan Masakan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengguna') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengaturan') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<style>
    .main-sidebar {
        background-color: #2d3d56;
    }

    .user-panel {
        background: #4e5d77;
        padding: 15px;
        border-radius: 8px;
    }

    .user-panel .image img {
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .nav-sidebar .nav-item:hover {
        background-color: #6c7d94;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .nav-sidebar .nav-link:hover .nav-icon {
        color: #ffcc00;
    }

    .nav-sidebar .nav-link .nav-icon {
        font-size: 18px;
        color: #f1f1f1;
        transition: color 0.3s ease;
    }

    .nav-sidebar .nav-item.active > .nav-link {
        background-color: #4e73df;
        color: white;
    }

    .nav-sidebar .nav-link {
        padding: 12px 15px;
        font-size: 16px;
    }
</style>
