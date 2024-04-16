{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Berkala</title>

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

    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <!-- SummerNote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
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
                        <h1 class="m-0">Log Laporan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">
                    <i class="fas fa-arrow-left"></i> <span style="margin-left: 5px">Kembali</span>
                </a>
                



                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        @foreach($log as $item)
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                    <span> {{ \App\Models\User::find($item->upload_by)->name }} <span
                                            class="badge badge-success"
                                            style="margin-left: 5px">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($item->upload_by)->role) }}</span></span>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="d-flex align-items-center">
                                        {{ $item->status }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.content -->
    </div>

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

<script>
    $(document).ready(function () {
        // Handle edit button click
        $(document).on('click', '.btn-edit', function () {
            // Example: Get document ID from data attribute
            var id = $(this).data('id');
            // Example: You can fetch document data via AJAX based on ID
            // Once you have the data, you can populate the form fields accordingly
            // For demonstration purpose, let's assume we're populating a document name field
            var documentName = "Document " + id;
            $('#document-name').val(documentName);
        });

        // Handle save changes button click
        $('#save-changes-btn').click(function () {
            // Example: Perform AJAX request to save changes
            // Serialize form data
            var formData = $('#edit-document-form').serializeArray();
            // Example: You can then submit this form data via AJAX
            console.log(formData); // Example: Output the serialized form data to console
            // Example: You can perform AJAX request here to save changes
            // Example: $.ajax({...});
            // Example: Upon success, you can close the modal
            $('#modal-edit-document').modal('hide');
        });
    });
</script>



</body>
</html>
