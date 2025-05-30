<aside class="main-sidebar elevation-4" style="background: linear-gradient(180deg, #2d3d56, #1c2636);">
    <!-- Logo -->
    <a href="#" class="brand-link d-flex justify-content-center align-items-center" style="background: linear-gradient(180deg, #2d3d56, #1c2636);">
        <img src="{{ asset('image/logo1.png') }}" alt="Logo Resep" class="brand-image" style="max-width: 180px; max-height: 120px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Manajemen Pengguna -->
                <li class="nav-item has-treeview {{ request()->is('user*') || request()->is('role*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('user*') || request()->is('role*') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Pengguna & Akses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('role*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>Peran Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link {{ request()->is('user*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Data Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Manajemen Resep -->
                <li class="nav-item has-treeview {{ request()->is('menu*') || request()->is('kategori*') || request()->is('ingredients*') || request()->is('tags*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('menu*') || request()->is('kategori*') || request()->is('ingredients*') || request()->is('tags*') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Manajemen Resep
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('menu') }}" class="nav-link {{ request()->is('menu*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Kelola Resep</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kategori') }}" class="nav-link {{ request()->is('kategori*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-th-large nav-icon"></i>
                                <p>Kategori Resep</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('ingredients') }}" class="nav-link {{ request()->is('ingredients*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-carrot nav-icon"></i>
                                <p>Bahan Masakan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}" class="nav-link {{ request()->is('tags*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Tag Resep</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pengaturan -->
                <li class="nav-item">
                    <a href="{{ url('pengaturan') }}" class="nav-link {{ request()->is('pengaturan') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    .nav-sidebar .nav-item:hover {
        background-color: #3f4f6b;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .nav-sidebar .nav-link .nav-icon {
        font-size: 18px;
        color: #e0e0e0;
        transition: color 0.3s ease;
    }

    .nav-sidebar .nav-link:hover .nav-icon {
        color: #a3ffac;
    }

    .nav-sidebar .nav-link {
        padding: 12px 15px;
        font-size: 16px;
        color: #f8f9fa;
    }

    .nav-treeview .nav-link {
        font-size: 15px;
        padding-left: 30px;
    }

    /* Aktif styling */
    .active-custom {
        background: linear-gradient(to right, #4e73df, #1cc88a) !important;
        color: #fff !important;
        border-radius: 5px;
    }

    .active-custom-sub {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffffff !important;
        border-left: 4px solid #1cc88a;
        font-weight: bold;
    }

    .nav-link.active-custom-sub .nav-icon {
        color: #1cc88a !important;
    }
</style>
