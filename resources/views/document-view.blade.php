<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
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
    <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Document Management<span></span></h1>
                <h2>disini anda dapat melihat setiap document yang tersedia</h2>
            </div>
        </div>
    </div>
</section>

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
            
            
            
            
            <!-- /.content -->
        </div>
    </div>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="form-inline">
                <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 100%; height: 80px; border: 2px solid #00000a;">
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
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Doc Number</th>
                                    <th scope="col">Doc Name</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $e)
                                    @if($e->give_access_to == 0)
                                        <tr>
                                            <td>{{ $e->nomor_dokumen }}</td>
                                            <td>
                                                <div class="user-panel d-flex">
                                                    <div class="d-flex align-items-center">
                                                        @if(strlen($e->name) > 75)
                                                            <a href="{{ route('document-detail', ['id' => $e->id]) }}">{{ substr($e->name, 0, 75) }}...</a>
                                                        @else
                                                            <a href="{{ route('document-detail', ['id' => $e->id]) }}">{{ $e->name }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                <td>
                                                    <span class="d-block">
                                                        @php
                                                            $accessor = explode(";", $e->give_access_to);
                                                        @endphp

                                                        @foreach($accessor as $acc)
                                                            <span class="badge badge-primary">
                                                                @if($acc == 0)
                                                                    All
                                                                @else
                                                                    {{ \App\Models\RoleModel::find($acc)->role }}
                                                                @endif
                                                            </span>
                                                        @endforeach
                                                    </span>
                                                </td>
                                            @endif
                                            <td style="vertical-align: middle;">
                                                <div class="user-panel d-flex">
                                                    <div class="info">
                                                        <span><span class="badge badge-success">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($e->created_by)->role) }}</span></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="user-panel d-flex">
                                                    <div class="info">
                                                        {{ $e->keterangan_status == 0 ? 'Tidak Berlaku' : 'Berlaku' }}
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
</div>
    
    @include('components.guessfooter')
    {{-- Copyright © 2024 Informatika 2021 Kelompok 1. All rights reserved. --}}

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


</script>
</body>
</html>