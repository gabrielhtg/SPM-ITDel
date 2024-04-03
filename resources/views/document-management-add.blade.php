{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Settings</title>

    {{-- @php
    dd($documenthero);
    @endphp --}}

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
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
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
                        <h1 class="m-0">Document Management</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">


                <a href="#modal-add-document" class="btn btn-success mb-3" data-toggle="modal">
                    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambah Laporan</span>
                </a>

                <a href="#modal-success2" class="btn btn-success mb-3" data-toggle="modal">
                    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambah Tipe Laporan</span>
                </a>


                @if(app(AllServices::class)->isAdmin())
                    @include('components.list-document-pending-modal')
                @endif


                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>

                        <th>Nama</th>
                        <th>Periode</th>
                        <th>Tipe Laporan</th>

                        <th>Status</th>
                        <th>Tindakan</th>

                    </tr>
                    </thead>
                    <tbody>

                            <tr>

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            Miko
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            April
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            Laporan Kerja
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            Waiting
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="#" target="_blank" class="btn btn-success"><i
                                                class="fas fa-eye"></i></a>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-detail-document"><i class="fas fa-info-circle fa-inverse"></i></button>

                                        {{-- // jika user sekarang == user yang upload di data Dokumen
                                        // if userSekarang -> id == document->created_by --}}
                                            <a href="#"
                                               class="btn btn-success"><i class="fas fa-edit"></i></a>

                                    </div>

                                </td>
                            </tr>
                    </tbody>
                </table>

                <div class="modal fade" id="modal-add-document" tabindex="-1" role="dialog" aria-labelledby="modal-add-document-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-document-label">Tambah Dokumen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="document-form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="document-name">Nama Dokumen</label>
                                        <input type="text" class="form-control" id="document-name" name="document-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="document-period">Periode</label>
                                        <input type="text" class="form-control" id="document-period" name="document-period" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="document-type">Jenis Dokumen</label>
                                        <select class="form-control" id="document-kind" name="document-type" required>
                                            <option value="">Pilih Jenis Dokumen</option> <!-- Opsi kosong -->
                                            <option value="Tipe 1">Revisi</option>
                                            <option value="Tipe 2">Baru</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="document-type">Tipe Dokumen</label>
                                        <select class="form-control" id="document-type" name="document-type" required>
                                            <option value="">Pilih Tipe Dokumen</option> <!-- Opsi kosong -->
                                            <option value="Tipe 1">Tipe 1</option>
                                            <option value="Tipe 2">Tipe 2</option>
                                            <option value="Tipe 3">Tipe 3</option>
                                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="document-file">Dokumen:</label>
                                        <input type="file" class="form-control-file" id="document-file" name="document-file" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" form="document-form">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="modal-success2">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Document Type</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form-register" method="POST" action="{{ route('uploadTypeDocument') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="jenis_dokumen">Document Type</label>
                                        <input type="text" name="jenis_dokumen" placeholder="Document Type" class="form-control" required>
                                        <div class="invalid-feedback">Please provide a valid document type.</div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


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
<script src="{{ asset("plugins/select2/js/select2.full.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 10,
            "order": [[4, "desc"]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Search Document Type",
            allowClear: true,
            minimumInputLength: 1 // Minimum characters to start searching
        });
    });

</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        // Mendapatkan opsi yang dipilih dari modal dan menetapkannya kembali saat modal dibuka
        $('.modal').on('show.bs.modal', function () {
            var modalId = $(this).attr('id');
            var selectedOptions = $('#' + modalId + ' .selected-roles').val();
            $('#' + modalId + ' .select2').val(selectedOptions).trigger('change');
        });
    });
</script>
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote({
            minHeight: 230,
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
