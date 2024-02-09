<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Settings</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <h1 class="m-0">Users Settings</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">

                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success1">
                    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add User Manually</span>
                </button>

                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success2">
                    <i class="fas fa-share-alt"></i> <span style="margin-left: 5px">Add User via Link</span>
                </button>

                <div class="modal fade" id="modal-success1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form-register" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required autofocus autocomplete="name">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                    <div class="input-group mt-3">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autocomplete="username">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope" style="font-size: 14px"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                    <div class="input-group mt-3">
                                        <input type="password"
                                               class="form-control"
                                               name="password"
                                               id="password"
                                               placeholder="Password" required autocomplete="new-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('password') }}</span>

                                    <div class="input-group mt-3">
                                        <input type="password"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               class="form-control"
                                               placeholder="Retype password" required autocomplete="new-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                                    <div class="input-group mt-3">
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="">-- Select Role --</option>
                                            <option value="1">Rektor</option>
                                            <option value="2">Wakil Rektor</option>
                                            <option value="3">Ketua SPPM</option>
                                            <option value="4">Anggota SPPM</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-tag" style="font-size: 12px"></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="form-register" class="btn btn-primary">Add User</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="modal-success2">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User via Link</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="GET" action="{{ route('register-invitation') }}">
                                    @csrf
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="username">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope" style="font-size: 14px"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                    <div class="input-group mt-3">
                                        <select class="form-control" name="role" required>
                                            <option value="">-- Select Role --</option>
                                            <option value="1">Rektor</option>
                                            <option value="2">Wakil Rektor</option>
                                            <option value="3">Ketua SPPM</option>
                                            <option value="4">Anggota SPPM</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-tag" style="font-size: 12px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3"></div>
                                    <textarea id="summernote" name="pesan">
                                        Berikut ini kami berikan link yang dapat anda gunakan untuk melakukan pendaftaran.
                                    </textarea>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary mt-4">Send Invitation Link</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $e)
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="image">
                                        <img src="{{ $e->profile_pict }}" class="img-circle custom-border" alt="User Image">
                                    </div>
                                    <div class="info">
                                        <span class="d-block">{{ $e->name }}</span>
                                    </div>
                                </div>
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
                                            @if($e->role === 1)
                                                Rektor
                                            @elseif($e->role === 2)
                                                Wakil Rektor
                                            @elseif($e->role === 3)
                                                Ketua SPPM
                                            @elseif($e->role === 4)
                                                Anggota SPPM
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <span class="d-block">
                                            {{ $e->created_at }}
                                        </span>
                                    </div>
                                </div>
                                </td>
                            <td>
                                <form action="{{ route('remove-user') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{ $e->id }}">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
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
<script src={{ asset("plugins/pdfmake/pdfmake.min.js") }}></script>
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
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength" : 10
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script>
    $(function() {
        @if(session('toastData') !== null)
            if({!! session('toastData')['success'] !!})
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{!! session('toastData')['text'] !!}',
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                })
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
