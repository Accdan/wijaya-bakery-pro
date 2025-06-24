<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Manajemen Resep Makanan Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo1.png') }}">

    <!-- CSS -->
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
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('include.navbarSistem')
        @include('include.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                   <!-- Row Horizontal: Statistik, Promo & Sponsor -->
                    <div class="row">
                        <!-- Kategori -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $totalKategori ?? 0 }}</h3>
                                    <p>Kategori Roti</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-th-list"></i>
                                </div>
                                <a href="{{ url('kategori') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Menu -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalMenu ?? 0 }}</h3>
                                    <p>Total Menu Roti</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <a href="{{ url('menu') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Promo -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $totalPromo ?? 0 }}</h3>
                                    <p>Total Promo</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <a href="{{ url('promo') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Sponsor -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{ $totalSponsor ?? 0 }}</h3>
                                    <p>Total Sponsor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <a href="{{ url('sponsor') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- Row 3: Info Resep -->
                    <div class="row">
                        <section class="col-lg-7 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-bullhorn"></i> Info Resep Terbaru
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-center text-muted">Tidak ada pengumuman terbaru.</p>
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

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Aktifkan treeview dropdown
            $('[data-widget="treeview"]').each(function () {
                AdminLTE.Treeview._jQueryInterface.call($(this));
            });
        });
    </script>
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

            $('[data-widget="treeview"]').each(function () {
                AdminLTE.Treeview._jQueryInterface.call($(this));
            });
        });
    </script>
</body>
</html>
