<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
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
                        <h1 class="m-0"><i class="fas fa-edit"></i> Ubah Kategori</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="card-title"><i class="fas fa-pencil-alt"></i> Form Ubah Kategori</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="kategori_name"><i class="fas fa-id-badge"></i> Nama Kategori</label>
                                <input type="text" class="form-control @error('kategori_name') is-invalid @enderror"
                                       name="kategori_name" value="{{ old('kategori_name', $kategori->kategori_name) }}" required>
                                @error('kategori_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_description"><i class="fas fa-align-left"></i> Deskripsi</label>
                                <textarea class="form-control @error('kategori_description') is-invalid @enderror"
                                          name="kategori_description" rows="3" required>{{ old('kategori_description', $kategori->kategori_description) }}</textarea>
                                @error('kategori_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_status"><i class="fas fa-toggle-on"></i> Status</label>
                                <select class="form-control @error('kategori_status') is-invalid @enderror"
                                        name="kategori_status">
                                    <option value="1" {{ old('kategori_status', $kategori->kategori_status) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('kategori_status', $kategori->kategori_status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('kategori_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
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
