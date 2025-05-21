<!-- bagian <head> tetap -->
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ubah Menu</title>
        <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ubah Menu</h1>
                        </div>
                    </div>
                </div>
            </div>
    
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Menu</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
    
                            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                <div class="row">
                                    <!-- Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_menu">Nama Menu</label>
                                            <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                                            @error('nama_menu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="kategori_id">Kategori</label>
                                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $menu->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="deskripsi_menu">Deskripsi</label>
                                            <textarea name="deskripsi_menu" rows="3" class="form-control @error('deskripsi_menu') is-invalid @enderror" required>{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
                                            @error('deskripsi_menu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
    
                                    <!-- Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prosedur">Prosedur</label>
                                            <textarea name="prosedur" rows="5" class="form-control @error('prosedur') is-invalid @enderror" required>{{ old('prosedur', $menu->prosedur) }}</textarea>
                                            @error('prosedur')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="gambar_menu">Gambar Menu</label>
                                            <input type="file" name="gambar_menu" class="form-control-file @error('gambar_menu') is-invalid @enderror" accept="image/*">
                                            @error('gambar_menu')<div class="text-danger">{{ $message }}</div>@enderror
                                            <div class="mt-2">
                                                @if($menu->gambar_menu)
                                                    <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="Gambar Menu" class="img-thumbnail" width="200">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Batal</a>
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
    