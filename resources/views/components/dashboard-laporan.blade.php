{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Laporan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <!-- SummerNote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    {{--    <link rel="stylesheet" href="{{ asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">--}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include("components.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("components.sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Laporan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @php
                // Urutkan jenis_laporan berdasarkan tahun dari besar ke kecil
                $jenis_laporan_sorted = $jenis_laporan->sortByDesc('year');
                // Inisialisasi tahun sebelumnya
                $prevYear = null;
                // Ambil daftar tahun unik dari JenisLaporan
                $colors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger'];
                $colorIndex = 0;
                $rowCount = 0;
            @endphp
            @foreach ($jenis_laporan_sorted as $item)
                @if ($prevYear !== null && $item->year === $prevYear)
                    @continue
                @endif
                @if ($rowCount % 4 === 0)
                    <div class="row">
                @endif
                <div class="col-md-3">
                    <!-- small box -->
                    <div class="small-box {{ $colors[$colorIndex] }}">
                        <div class="inner">
                            <h3>{{ $item->year }}</h3>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('getDashboardlaporanContinue', ['year' => $item->year]) }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @php
                    // Atur tahun sebelumnya ke tahun saat ini
                    $prevYear = $item->year;
                    // Ganti indeks warna untuk variasi
                    $colorIndex = ($colorIndex + 1) % count($colors);
                    $rowCount++;
                @endphp
                @if ($rowCount % 4 === 0)
                    </div><!-- /.row -->
                @endif
            @endforeach
            @if ($rowCount % 4 !== 0)
                </div><!-- /.row -->
            @endif
        </div><!-- /.container-fluid -->
    </section>
    
    
    <!-- /.content -->
</div>

    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@include('components.footer')

<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<!-- Page specific script -->
<script>
    // Add your custom scripts here
</script>
</body>
</html>
