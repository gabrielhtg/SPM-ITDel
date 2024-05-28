<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset("plugins/jqvmap/jqvmap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("plugins/daterangepicker/daterangepicker.css") }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("splide/dist/css/splide.min.css") }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">

    <!-- Meta tag viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset("src/img/logo.png") }}" alt="LogoDel" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include("components.guessnavbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    {{-- @include("components.sidebar") --}}

    @foreach($documenthero as $s)
        {{-- @php
        dd($s->imagehero);
        @endphp --}}
        <section id="hero" class="background-under-navbar d-flex align-items-center justify-content-center" style="background: url('{{ asset('src/img/' . $s->imagehero) }}') top center; background-size: cover; position: relative;">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-xl-6 col-lg-8">
                        <h1>{{ $s->titlehero }}</h1>
                        <h2>{{ $s->descriptionhero }}</h2>
                    </div>
                </div>
            </div>
        </section>
    @endforeach


    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="content px-5">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="form-inline">
                            <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Cari"
                                   aria-label="Search" style="width: 100%; height: 80px; border: 2px solid #00000a;">
                        </form>
                    </div>
                </div>
            </div>

            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="border-radius: 30px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless" style="width: 100%;">
                                        <thead class="table-primary custom-thead">
                                        <tr>
                                            <th scope="col ">Nomor Dokumen</th>
                                            <th scope="col">Nama Dokumen</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($documents as $e)
                                            @if((strpos($e->give_access_to, '0') !== false))
                                                <tr>
                                                    <td>{{ $e->nomor_dokumen }}</td>
                                                    <td>
                                                        <div class="user-panel d-flex">
                                                            <div class="d-flex align-items-center">
                                                                @if(strlen($e->name) > 30)
                                                                    <a href="{{ route('document-detail', ['id' => $e->id]) }}">
                                                                            <?php
                                                                            $name = $e->name;
                                                                            while(strlen($name) > 30) {
                                                                                echo substr($name, 0, 30) . "<br>";
                                                                                $name = substr($name, 30);
                                                                            }
                                                                            echo $name;
                                                                            ?>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('document-detail', ['id' => $e->id]) }}">{{ $e->name }}</a>
                                                                @endif
                                                                </div>
                                                        </div>
                                                    </td>

                                                    <td class="bold" style="font-size: 18px;">
                                                        {!! strlen($e->deskripsi) > 40 ? substr($e->deskripsi, 0, 40) . '...' : $e->deskripsi !!}
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="user-panel d-flex">
                                                            <div class="info">
                                                                @php
                                                                    if($e->keterangan_status == 0) {
                                                                        echo 'Tidak Berlaku';
                                                                    } else {
                                                                        echo 'Berlaku';
                                                                    }
                                                                @endphp
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>
<!-- /.content -->
</div>
</div>
@include('components.guessfooter')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- ChartJS -->
<script src="{{ asset("plugins/chart.js/Chart.min.js") }}"></script>
<!-- Sparkline -->
<script src="{{ asset("plugins/sparklines/sparkline.js") }}"></script>
<!-- JQVMap -->
<script src="{{ asset("plugins/jqvmap/jquery.vmap.min.js") }}"></script>
<script src="{{ asset("plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("plugins/jquery-knob/jquery.knob.min.js") }}"></script>
<!-- daterangepicker -->
<script src="{{ asset("plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}"></script>
<!-- Summernote -->
<script src="{{ asset("plugins/summernote/summernote-bs4.min.js") }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.js") }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="{{ asset("dist/js/demo.js") }}"></script>--}}

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.js") }}"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true
        });
    });
</script>



<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var searchText = $(this).val().toLowerCase();

            // Loop through all table rows
            $('table tbody tr').each(function () {
                var found = false;

                // Check if the search text matches the Doc Number or Doc Name
                $(this).find('td:nth-child(1), td:nth-child(2)').each(function () {
                    var cellText = $(this).text().toLowerCase();
                    if (cellText.includes(searchText)) {
                        found = true;
                        return false; // Break the loop if found
                    }
                });

                // Show or hide the row based on the search result
                if (found) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

</body>
</html>
