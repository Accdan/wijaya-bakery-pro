<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajemen Resep Makanan Indonesia</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .fc-daygrid-day-number {
            color: white !important;
        }
        .fc-daygrid-day {
            border: none !important;
        }
        /* Styling sidebar background */
.main-sidebar {
    background-color: #2d3d56; /* Dark Blue Sidebar */
}

/* Styling user panel */
.user-panel {
    background: #4e5d77; /* Darker Shade for User Panel */
    padding: 15px;
    border-radius: 8px;
}

.user-panel .image img {
    border-radius: 50%;
    border: 2px solid #fff;
}

/* Hover effect on menu items */
.nav-sidebar .nav-item:hover {
    background-color: #6c7d94;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

/* Hover icon color change */
.nav-sidebar .nav-link:hover .nav-icon {
    color: #ffcc00;
}

/* Icon styling */
.nav-sidebar .nav-link .nav-icon {
    font-size: 18px; /* Enlarging icons */
    color: #f1f1f1;
    transition: color 0.3s ease;
}

/* Active item */
.nav-sidebar .nav-item.active > .nav-link {
    background-color: #4e73df;
    color: white;
}

/* Adjust padding and spacing */
.nav-sidebar .nav-link {
    padding: 12px 15px;
    font-size: 16px;
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Resep -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalResep ?? 0 }}</h3>
                                <p>Total Resep</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <a href="{{ url('resep') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Total Kategori -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalKategori ?? 0 }}</h3>
                                <p>Kategori Resep</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-th-list"></i>
                            </div>
                            <a href="{{ url('kategori') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Total Bahan -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning text-white">
                            <div class="inner">
                                <h3>{{ $totalBahan ?? 0 }}</h3>
                                <p>Bahan Masakan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-carrot"></i>
                            </div>
                            <a href="{{ url('bahan') }}" class="small-box-footer text-white">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Total Pengguna -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $totalPengguna ?? 0 }}</h3>
                                <p>Pengguna Aktif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ url('pengguna') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-bullhorn"></i> Info Resep Terbaru</h3>
                            </div>
                            <div class="card-body">
                                {{-- @if (count($pengumumans) > 0)
                                    <ul class="list-group">
                                        @foreach ($pengumumans as $pengumuman)
                                            <li class="list-group-item">
                                                <h5 class="mb-1">{{ $pengumuman->judul }}</h5>
                                                <p class="mb-1 text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 100) }}</p>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($pengumuman->tanggal_dibuat)->format('d M Y') }}</small>
                                                <a href="{{ url('pengumuman/' . $pengumuman->pengumuman_id) }}" class="btn btn-sm btn-primary float-right">Read More</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-center text-muted">Tidak ada pengumuman terbaru.</p>
                                @endif --}}
                            </div>
                        </div>
                    </section>
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
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="{{ asset('resources/js/ToastScript.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id'
            });
            calendar.render();
        }
    });

    $(document).ready(function () {
        $('[data-widget="treeview"]').each(function () {
            AdminLTE.Treeview._jQueryInterface.call($(this));
        });
    });
</script>
</body>
</html>
