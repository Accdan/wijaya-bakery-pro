<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Sponsor</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
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
                        <h1 class="m-0">Ubah Sponsor</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Sponsor</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.sponsor.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_sponsor">Nama Sponsor</label>
                                        <input type="text" class="form-control @error('nama_sponsor') is-invalid @enderror" name="nama_sponsor" value="{{ old('nama_sponsor', $sponsor->nama_sponsor) }}" required>
                                        @error('nama_sponsor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi_sponsor') is-invalid @enderror" required>{{ old('deskripsi_sponsor', $sponsor->deskripsi_sponsor) }}</textarea>
                                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6 text-center">
                                    <div class="form-group">
                                        <label for="logo">Logo Sponsor</label>
                                        <input type="file" name="logo_input" id="logo" class="form-control-file @error('logo') is-invalid @enderror" accept="image/*">
                                        @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div style="width: 300px; height: 300px; border: 2px dashed #ccc; margin: auto; display: flex; align-items: center; justify-content: center;">
                                        <img id="preview" src="{{ $sponsor->logo ? asset('storage/' . $sponsor->logo) : 'https://via.placeholder.com/300x300?text=Preview' }}" class="img-fluid rounded" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                    <input type="hidden" name="cropped_logo" id="cropped_logo">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('admin.sponsor.index') }}" class="btn btn-secondary">Batal</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper;
    const image = document.getElementById('preview');
    const input = document.getElementById('logo');

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            image.src = reader.result;

            if (cropper) cropper.destroy();
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                crop() {
                    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
                    canvas.toBlob((blob) => {
                        const fileReader = new FileReader();
                        fileReader.onloadend = () => {
                            document.getElementById('cropped_logo').value = fileReader.result;
                        };
                        fileReader.readAsDataURL(blob);
                    });
                }
            });
        };
        reader.readAsDataURL(file);
    });
</script>
</body>
</html>
