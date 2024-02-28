@php use App\Services\CustomConverterService; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Settings</title>

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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Inactive Users</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">

                <div class="mb-3 d-flex flex-wrap" style="gap: 5px">
{{--                    @include('components.add-user-manually-modal')--}}
{{--                    @include('components.add-user-via-invite-link')--}}
{{--                    --}}{{--                @include('components.list-invited-user')--}}
{{--                    <a href='{{ route('list-allowed-user') }}' class="btn btn-success">--}}
{{--                        List Allowed User--}}
{{--                    </a>--}}
{{--                    @include('components.list-password-reset-request')--}}
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>IP Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $e)

                        @if($e->id == auth()->user()->id)
                            @continue
                        @else
                            <tr>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            @if($e->profile_pict == null)
                                                <img src="{{ asset('src/img/default-profile-pict.png') }}" class="img-circle custom-border" alt="User Image">
                                            @else
                                                <img src="{{ asset($e->profile_pict) }}" class="img-circle custom-border" alt="User Image">
                                            @endif
                                        </div>
                                        <div class="info">
                                            <span class="d-block">{{ $e->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                            <span class="d-block">{{ $e->username }}</span>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                            <span class="d-block"> {{ $e->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                        <span class="d-block">
                                            {{ app(CustomConverterService::class)->convertRole($e->role) }}
                                        </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        @if($e->ip_address !== null)
                                            {{ $e->ip_address }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        {{ $e->phone }}
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex" style="gap: 10px">
                                        <form action="{{ route('getUserDetail') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $e->id }}">
                                            <button type="submit" class="btn btn-success"><i class="far fa-eye" style="font-size: 14px"></i></button>
                                        </form>
                                        <form action="{{ route('restoreAccount') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $e->id }}">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-redo" style="font-size: 14px"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
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
<script>
    let table = new DataTable('#example1', {
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [
            {
                extend: 'pdf',
                filename: 'User Settings Data',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [
                        0, 1, 2, 3, 4, 5
                    ]
                },
                orientation: "landscape"
            },
            {
                extend: 'excel',
                filename: 'User Settings Data',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [
                        0, 1, 2, 3, 4, 5
                    ]
                },
            },
            {
                extend: 'print',
                filename: 'User Settings Data',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [
                        0, 1, 2, 3, 4, 5
                    ]
                },
            },
            {
                extend: 'colvis',
                columns: [
                    0, 1, 2, 3, 4, 5
                ]
            },
        ],
        "pageLength": 10,
        "select": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

</script>
<script>
    $(function () {
        @if(session('toastData') != null)
        @if(session('toastData')['success'])
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{!! session('toastData')['text'] !!}',
            toast: true,
            showConfirmButton: false,
            position: 'top-end',
            timer: 3000
        })
        @else
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: '{!! session('toastData')['text'] !!}',
            toast: true,
            showConfirmButton: false,
            position: 'top-end',
            timer: 5000
        })
        @endif
        @endif

        @if (!$errors->isEmpty())
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Failed to add user! {!! $errors->first('name') !!}{!! $errors->first('email') !!}{!! $errors->first('password') !!}',
            toast: true,
            showConfirmButton: false,
            position: 'top-end',
            timer: 5000
        })
        @endif
    });
</script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            disableDragAndDrop: true,
        })
    })
</script>
</body>
</html>
