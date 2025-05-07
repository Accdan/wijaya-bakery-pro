<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .profile-img {
            width: 180px;
            height: 220px;
            object-fit: cover;
            border: 3px solid #dee2e6;
            border-radius: 10px;
        }
        .table th {
            background-color: #f8f9fa;
            width: 35%;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-user-circle"></i> Detail Pengguna</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container d-flex justify-content-center">
                <div class="card shadow-lg" style="width: 70%;">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-info-circle"></i> Informasi Lengkap</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center mb-3">
                                <img src="{{ $pengguna->profile_picture ? asset('storage/' . $pengguna->profile_picture) : asset('image/default-avatar.png') }}"
                                     class="profile-img img-fluid rounded" alt="Foto Profil">
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th><i class="fas fa-id-badge"></i> ID Pengguna</th>
                                        <td>{{ $pengguna->id }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-user"></i> Nama</th>
                                        <td>{{ $pengguna->nama_pengguna }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-envelope"></i> Email</th>
                                        <td>{{ $pengguna->email }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-user-tag"></i> Username</th>
                                        <td>{{ $pengguna->username }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-users-cog"></i> Peran</th>
                                        <td>{{ $pengguna->role->role_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-phone-alt"></i> No. Telepon</th>
                                        <td>{{ $pengguna->no_telepon ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.logoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
