<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Hero</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
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
                        <h1 class="m-0">Manajemen Hero</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Hero</h3>
                        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Hero
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="heroTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($heroes as $index => $hero)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($hero->gambar)
                                                <img src="{{ asset('uploads/hero/' . $hero->gambar) }}" alt="hero" width="100">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $hero->status ? 'success' : 'secondary' }}">
                                                {{ $hero->status ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm delete-hero-btn"
                                                    data-toggle="modal"
                                                    data-target="#deleteHeroModal"
                                                    data-id="{{ $hero->id }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteHeroModal" tabindex="-1" aria-labelledby="deleteHeroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteHeroModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus gambar hero ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <form id="deleteHeroForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#heroTable").DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true
        });

        $('.delete-hero-btn').click(function () {
        let heroId = $(this).data('id');
        let deleteUrl = "{{ route('admin.hero.destroy', '__id__') }}".replace('__id__', heroId);
        $('#deleteHeroForm').attr('action', deleteUrl);
    });


        @if (session('success') || session('error'))
        $('#toastNotification').toast({
            delay: 3000,
            autohide: true
        }).toast('show');
        @endif
    });
</script>
</body>
</html>
