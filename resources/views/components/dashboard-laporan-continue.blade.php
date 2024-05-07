{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Laporan</title>

    <!-- Google Font: Source Sans Pro -->
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

    <div class="content-wrapper" style="min-height: 1345.31px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Laporan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach($tipe_laporan as $item)
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">{{$item->nama_laporan}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="barChart_{{ $item->id }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 557px;" width="557" height="250" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
</div>
    @include('components.footer')

<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>

<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

<script src="{{ asset("plugins/chart.js/Chart.min.js") }}"></script>

<script src="{{ asset("dist/js/adminlte.min.js?v=3.2.0") }}"></script>

<script src="{{ asset("dist/js/demo.js") }}"></script>

<script src="{{ asset("plugins/chart.js/Chart.min.js") }}"></script>

<script>
    $(function () {
        @foreach($tipe_laporan as $tipe)
            @php
                // Ambil jenis laporan berdasarkan tipe laporan
                $jenis_laporan_ids = $tipe->jenis_laporan->pluck('id')->toArray();
                // Ambil nama jenis laporan berdasarkan id
                $jenis_laporan_names = \App\Models\JenisLaporan::whereIn('id', $jenis_laporan_ids)->pluck('nama')->toArray();
                // Hitung jumlah laporan yang sudah mengumpulkan per jenis
                $mengumpulkan_per_jenis = [];
                foreach ($jenis_laporan_ids as $jenis) {
                    $jumlah_mengumpulkan = \App\Models\LogLaporan::where('id_jenis_laporan', $jenis)->whereNotNull('status')->count();
                    array_push($mengumpulkan_per_jenis, $jumlah_mengumpulkan);
                }
                // Hitung jumlah laporan yang belum mengumpulkan per jenis
                $belum_mengumpulkan_per_jenis = [];
                foreach ($jenis_laporan_ids as $jenis) {
                    $jumlah_belum_mengumpulkan = \App\Models\LogLaporan::where('id_jenis_laporan', $jenis)->whereNull('status')->count();
                    array_push($belum_mengumpulkan_per_jenis, $jumlah_belum_mengumpulkan);
                }
            @endphp

            var labels_{{ $tipe->id }} = {!! json_encode($jenis_laporan_names) !!};
            var barChartCanvas{{ $tipe->id }} = $('#barChart_{{ $tipe->id }}').get(0).getContext('2d');
            var barChartData{{ $tipe->id }} = {
                labels  : labels_{{ $tipe->id }},
                datasets: [
                    {
                        label               : 'Sudah Mengumpulkan',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : {!! json_encode($mengumpulkan_per_jenis) !!}
                    },
                    {
                        label               : 'Belum Mengumpulkan',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : {!! json_encode($belum_mengumpulkan_per_jenis) !!}
                    },
                ]
            };
            new Chart(barChartCanvas{{ $tipe->id }}, {
                type: 'bar',
                data: barChartData{{ $tipe->id }},
                options: {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                }
            });
        @endforeach
    });
</script>












</body>
</html>
