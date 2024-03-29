@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Role Management</title>

    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
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
                        <h1 class="m-0">Role Management</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex flex-wrap" style="gap: 5px">
                    @include('components.add-role-modal')
                </div>

                <table id="table-role" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>
                            Role
                        </th>
                        <th>
                            Atasan
                        </th>
{{--                        <th>--}}
{{--                            Bawahan--}}
{{--                        </th>--}}
                        <th>
                            Responsible To
                        </th>
                        <th>
                            Accountable To
                        </th>
                        <th>
                            Informable To
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $e)
                        @if(!($e->role == "Admin"))
                            <tr>
                                <td>
                                    {{$e->role}}
                                </td>
                                <td>
                                    {{ AllServices::convertRole($e->atasan_id) }}
                                </td>
{{--                                <td>--}}
{{--                                    {{ AllServices::convertRole($e->bawahan) }}--}}
{{--                                </td>--}}
                                <td>
                                    {{ AllServices::convertRole($e->responsible_to) }}
                                </td>
                                <td>
                                    {{ AllServices::convertRole($e->accountable_to) }}
                                </td>
                                <td>
                                    {{ AllServices::convertRole($e->informable_to) }}
                                </td>
                                <td>
                                    <form action="{{ route('update-status') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn {{ $e->status ? 'btn-success' : 'btn-danger' }} btn-sm">
                                            {{ $e->status ? 'AKTIF' : 'TIDAK AKTIF' }}
                                        </button>

                                        <input type="hidden" name="id" value="{{ $e->id }}">
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-edit-role{{ $e->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                @foreach($roles as $e)
                    @if(!($e->role == "Admin"))
                        <div class="modal fade" id="modal-edit-role{{ $e->id }}">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Role</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-edit-role" action="{{route('editRole')}}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="nama-role{{ $e->id }}">Role Name</label>
                                                <input type="text" class="form-control" value="{{ $e->role }}" placeholder="Type Here"
                                                       id="nama-role{{ $e->id }}" name="nama_role" required autofocus>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="atasan-role{{ $e->id }}">Atasan</label>
                                                <select id="atasan-role{{ $e->id }}" name="atasan_role"
                                                        class="atasan-role-custom form-control" style="width: 100%">
                                                    <option></option>
                                                    @foreach($roles as $role)
                                                        @if($role->role !== "Admin")
                                                            @if($role->id == $e->atasan_id)
                                                                <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                                            @else
                                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="accountable-to{{ $e->id }}">Accountable To:</label>
                                                <select id="accountable-to{{ $e->id }}" name="accountable_to[]"
                                                        multiple="multiple" class="accountable-to-custom form-control"
                                                        style="width: 100%">
                                                    <option></option>
                                                    @foreach($roles as $role)
                                                        @if($role->role !== "Admin")
                                                            @if(AllServices::isThisRoleExistInArray($e->accountable_to, $role))
                                                                <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                                            @else
                                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="informable-to{{ $e->id }}">Informable To:</label>
                                                <select id="informable-to{{ $e->id }}" name="informable_to[]"
                                                        class="informable-to-custom form-control" multiple="multiple"
                                                        style="width: 100%">
                                                    <option></option>
                                                    @if($role->role !== "Admin")
                                                        @if(AllServices::isThisRoleExistInArray($e->informable_to, $role))
                                                            <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                                        @else
                                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                        @endif
                                                    @endif
                                                </select>
                                            </div>

                                            <input type="hidden" value="{{ $e->id }}" name="id">
                                        </form>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" form="form-edit-role">Edit</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @endif
                @endforeach
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
<script src="{{ asset("plugins/jquery/jquery.min.js")  }}"></script>
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
<!-- AdminLTE App -->
<script src="{{ asset("plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Page specific script -->
<script>
    let tableRole = new DataTable('#table-role', {
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 10,
    });
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
        //Initialize Select2 Elements
        $('.atasan-role-custom').select2({
            placeholder: "Select role",
            allowClear: true,
        });
        $('.accountable-to-custom').select2({
            placeholder: "Select role",
            allowClear: true,
        });
        $('.informable-to-custom').select2({
            placeholder: "Select role",
            allowClear: true,
        });
    })
</script>
</body>
</html>
