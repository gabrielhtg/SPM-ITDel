@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Detail</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
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
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
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
                        <h1 class="m-0">About {{ $user->name }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline" style="min-height: 80vh">
                    <div class="card-body box-profile d-flex flex-column justify-content-center">
                        <div class="text-center">
                            @if($user->profile_pict == null)
                                <img src="{{ asset('src/img/default-profile-pict.png') }}"
                                     class="profile-user-img img-fluid img-circle" alt="User Image">
                            @else
                                <img src="{{ asset($user->profile_pict) }}"
                                     class="profile-user-img img-fluid img-circle" alt="User Image">
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h3 class="profile-username text-center">
                                {{ $user->name }}
                            </h3>
                            <div class="pt-2" style="margin-left: 5px">
                                @if($user->online)
                                    <i class="fas fa-circle text-success"
                                       style="font-size: 8px; padding-bottom: 20px"></i>
                                @else
                                    <i class="fas fa-circle text-danger"
                                       style="font-size: 8px; padding-bottom: 20px"></i>
                                @endif
                            </div>
                        </div>
                        <p class="text-muted text-center">{{ app(AllServices::class)->convertRole($user->role) }}</p>
                        <div class="d-flex justify-content-center">
                            <ul class="list-group list-group-unbordered mb-3" style="width: 500px">
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Nama Pengguna</b> <span class="float-right">{{ $user->username }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>No Telepon</b> <span class="float-right">{{ $user->phone }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Alamat Email</b> <span class="float-right">{{ $user->email }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Nama</b> <span class="float-right">{{ $user->name }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Role</b> <span
                                        class="float-right">{{ app(AllServices::class)->convertRole($user->role) }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Starts On</b> <span
                                        class="float-right">{{ AllServices::convertTime($user->created_at) }}</span>
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    @if($user->ends_on !== null)
                                        <b>Ends On</b> <span
                                            class="float-right">{{ AllServices::convertTime($user->ends_on) }}</span>
                                    @else
                                        <b>Ends On</b> <span
                                            class="float-right">-</span>
                                    @endif
                                </li>
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Last Online</b> <span class="float-right">
                                        @if($user->last_login_at !== null)
                                            {{ AllServices::getLastLogin($user->last_login_at) }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </li>
                                @if(AllServices::isCurrentRole("Admin"))
                                    <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                        <b>IP Address</b> <span class="float-right">
                                        @if($user->ip_address !== null)
                                                {{ $user->ip_address }}
                                            @else
                                                -
                                            @endif
                                    </span>
                                    </li>
                                @endif
                                <li class="list-group-item" style="padding-left: 10px; padding-right: 10px">
                                    <b>Account Status</b> <span
                                        class="float-right text-success text-bold">Active</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if(AllServices::isCurrentRole("Admin"))
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary mb-3"
                               href="https://www.infobyip.com/ip-{{ $user->ip_address }}.html">Check
                                IP Address</a>
                        </div>
                    @endif
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('components.footer')

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
<script src="{{ asset("plugins/select2/js/select2.full.min.js") }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
</body>
</html>
