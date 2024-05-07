@php use App\Services\AllServices; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karyawan</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/css/custom.css') }}">
    <!-- SummerNote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('components.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Karyawan</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 d-flex flex-wrap" style="gap: 5px">
                        @if (AllServices::isLoggedUserHasAdminAccess())
                            @include('components.add-employee-modal')
                        @endif
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $e)
                                <tr>
                                    <td>
                                        <div class="user-panel d-flex">
                                            <div class="info">
                                                <span class="d-block">{{$e->name}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-panel d-flex">
                                            <div class="info">
                                                <span class="d-block">{{ AllServices::convertRole($e->role) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-panel d-flex">
                                            <div class="info">
                                                @if(AllServices::isLoggedUserHasAdminAccess())
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete-{{ $e->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                             height="17" fill="currentColor" class="bi bi-person-dash"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                            <path
                                                                d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $e->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                    </svg>
                                                </button>


                                            </div>
                                        </div>
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

        @foreach ($employees as $e)
            <div class="modal fade" id="modal-delete-{{ $e->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($e->user_id !== null)
                                <p>
                                    Kamu tidak bisa melakukan aksi ini disini karena {{$e->name}} adalah User Aktif.
                                    Lakukan aksi kamu di <a href="/user-settings-active">Penguna Aktif</a>.
                                </p>
                            @else
                                <form id="form-delete-{{ $e->id }}" method="POST"
                                      action="{{ route('remove-employee') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $e->id }}">
                                </form>

                                <p>
                                    Apakah anda yakin akan menghapus karyawan {{ $e->name }}?
                                </p>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            @if($e->user_id === null)
                                <button type="submit" form="form-delete-{{ $e->id }}"
                                        class="btn btn-danger">Hapus</button>
                            @endif

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-edit-{{ $e->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($e->user_id !== null)
                                <p>
                                    Kamu tidak bisa melakukan aksi ini disini karena {{$e->name}} adalah User Aktif.
                                    Lakukan aksi kamu di <a href="/user-settings-active">Penguna Aktif</a>.
                                </p>
                            @else
                                <form id="form-edit-{{ $e->id }}" method="POST"
                                      action="{{ route('edit-employee') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ $e->name }}" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>

                                    <div class="row mt-3 bg-white">
                                        <div class="col">
                                            <div class="input-group w-100">
                                                <select name="role" class="form-control select2" style="width: 100%" required>
                                                    <option></option>
                                                    @foreach($roles as $role)
                                                        @if($role->status)
                                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{ $e->id }}">
                                </form>
                            @endif

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            @if($e->user_id === null)
                                <button type="submit" form="form-edit-{{ $e->id }}"
                                        class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/sweetalert.js') }}"></script>
    <!-- Page specific script -->
    <script>
        let table = new DataTable('#example1', {
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
            "select": true
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        let tableRole = new DataTable('#table-role', {
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
        });
    </script>
    <script>
        $(function() {
            @if (session('toastData') != null)
                @if (session('toastData')['success'])
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{!! session('toastData')['text'] !!}',
                        // toast: true,
                        showConfirmButton: false,
                        // position: 'top-end',
                        timer: 3000
                    })
                @else
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: '{!! session('toastData')['text'] !!}',
                        // toast: true,
                        showConfirmButton: false,
                        // position: 'top-end',
                        timer: 5000
                    })
                @endif
            @endif
        });
    </script>
    <script>
        $(function() {
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
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder: "Pilih role",
                allowClear: true
            });
        })
    </script>
</body>

</html>
