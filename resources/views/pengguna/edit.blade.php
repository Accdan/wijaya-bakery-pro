<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Pengguna</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
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
                        <h1 class="m-0"><i class="fas fa-user-edit"></i> Ubah Pengguna</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Data Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nama_pengguna"><i class="fas fa-user"></i> Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama_pengguna') is-invalid @enderror" name="nama_pengguna" value="{{ old('nama_pengguna', $pengguna->nama_pengguna) }}" required>
                                        @error('nama_pengguna')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="username"><i class="fas fa-user-tag"></i> Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $pengguna->username) }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $pengguna->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_telepon"><i class="fas fa-phone"></i> Nomor Telepon</label>
                                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon', $pengguna->no_telepon) }}" required>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="password"><i class="fas fa-lock"></i> Password <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role_id"><i class="fas fa-users-cog"></i> Role</label>
                                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                            <option value="">-- Pilih Role --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id', $pengguna->role_id) == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_picture"><i class="fas fa-image"></i> Foto Profil</label>
                                        <input type="file" name="profile_picture" class="form-control-file @error('profile_picture') is-invalid @enderror">
                                        @error('profile_picture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        @if($pengguna->profile_picture)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $pengguna->profile_picture) }}" alt="Foto Profil" class="img-thumbnail" width="120">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>
                            </div>
                        </form>
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
