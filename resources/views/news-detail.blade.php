@php use App\Services\AllServices; @endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <!-- SummerNote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include("components.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("components.sidebar")

    <div class="content-wrapper" style="min-height: 2488.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>News</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">News</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="text-bold">{{ $newsDetail->title }}</h3>
                        <p class="text-secondary">
                            Berlaku : 
                            {{ \Carbon\Carbon::parse($newsDetail->start_date)->format('d/m/Y') }}
                            @if($newsDetail->end_date != null)
                                - {{ \Carbon\Carbon::parse($newsDetail->end_date)->format('d/m/Y') }}
                            @else
                                - Sekarang
                            @endif
                        </p>
                    </div>
                    <div class="card-body d-flex flex-column ">
                        <img src="{{ asset('src/gambarnews/'.$newsDetail->bgimage) }}" alt="gambar tidak ditemukan" class="img-fluid align-self-center rounded" style="width: 500px;">
                        <p>{!! $newsDetail->description !!}</p>
                        <strong>Recommendations</strong>
                        <div>
                            <a href="https://fontawesome.com/">Font Awesome</a><br>
                            <a href="https://useiconic.com/open/">Iconic Icons</a><br>
                            <a href="https://ionicons.com/">Ion Icons</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">News</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card card-primary card-outline">
                <div class="card-header">
                <h3 class="card-title">Icons</h3>
                </div> 
                <div class="card-body">
                <p>You can use any font library you like with AdminLTE 3.</p>
                <strong>Recommendations</strong>
                <div>
                <a href="https://fontawesome.com/">Font Awesome</a><br>
                <a href="https://useiconic.com/open/">Iconic Icons</a><br>
                <a href="https://ionicons.com/">Ion Icons</a><br>
                </div>
                </div>
                </div>
            {{-- <div class="card-body">
                <section>
                    <h1>{{ $newsDetail->title }}</h1>
                </section>
                <section class="content" id="main-content">
                    <div class="page-header">
                        <h2>{{ $newsDetail->title }}</h2>
                        <p class="text-secondary">
                            Berlaku : 
                            {{ \Carbon\Carbon::parse($newsDetail->start_date)->format('d/m/Y') }}
                            @if($newsDetail->end_date != null)
                                - {{ \Carbon\Carbon::parse($newsDetail->end_date)->format('d/m/Y') }}
                            @else
                                - Sekarang
                            @endif
                        </p>
                    </div>

                    <div class="pengumuman-view">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-10 mt-4">
                                    <div class="box box-solid">
                                        <img src="{{ asset('src/gambarnews/'.$newsDetail->bgimage) }}" alt="gambar tidak ditemukan" class="img-fluid" style="width: 500px;">
                                    </div>
                                </div>
                                <div id="grid-system1" class="col-sm-10 mt-2">
                                    <div class="box box-solid">
                                        <div id="grid-system1-body" class="box-body">
                                            {!! $newsDetail->description !!}
                                        </div>
                                    </div>
                                </div>

                                <div id="grid-system2" class="col-sm-12 mt-5">
                                    <div class="box box-solid">
                                        <div id="grid-system2-body" class="box-body">
                                            <div style="border-top: 3px solid red; padding-top: 10px; margin-top:200px;">
                                                <div style="">
                                                    {{ $newsDetail->created_at->format('Y-m-d H:i:s') }}
                                                </div>

                                                <div style="margin-top:30px">
                                                    <p>ttd,</p>
                                                    {{ $loggedInUserName }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> --}}
            <!-- /.card-body -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('components.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{{ asset("plugins/datatables/jquery.dataTables.min.js") }}}"></script>
<script src="{{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("plugins/jszip/jszip.min.js") }}"></script>
<script src="{{ asset("plugins/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset("plugins/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset("plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("plugins/summernote/summernote-bs4.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<!-- Page specific script -->
</body>
</html>