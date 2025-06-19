<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || About & Contact</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <h1 class="m-0">About & Contact</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Tampilan Data</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.about_contact.edit', $data->id ?? 1) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body row">

                        <!-- ABOUT SECTION -->
                        <div class="col-md-6 mb-4">
                            <h5><i class="fas fa-info-circle"></i> Tentang Kami</h5>
                            @if($data && $data->about_picture)
                                <img src="{{ asset('uploads/about_contact/' . $data->about_picture) }}" class="img-fluid rounded mb-2" alt="About Image">
                            @endif
                            <div class="border p-3 bg-light" style="min-height: 150px;">
                                {!! $data->about_deskripsi !!}
                            </div>
                        </div>

                        <!-- CONTACT SECTION -->
                        <div class="col-md-6 mb-4">
                            <h5><i class="fas fa-phone"></i> Kontak</h5>
                            @if($data && $data->contact_picture)
                                <img src="{{ asset('uploads/about_contact/' . $data->contact_picture) }}" class="img-fluid rounded mb-2" alt="Contact Image">
                            @endif
                            <div class="border p-3 bg-light" style="min-height: 150px;">
                                {!! $data->contact_deskripsi !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
