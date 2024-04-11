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

                @if((app(AllServices::class)->isLoggedUserHasAdminAccess(auth()->user()->id)))
                @include('components.upload-tipe-laporan')
                <a href="{{ route('viewLaporanType') }}" class="btn btn-primary mb-3">
                    <i class="far fa-eye"></i> <span style="margin-left: 5px">Lihat Tipe Laporan</span>
                </a>
                
                @endif


            @php
            $isResponsiblenot = app(AllServices::class)->isnotAccountable(auth()->user()->role);
            // dd($isResponsible);
        @endphp

            @if($isResponsiblenot === false)
            @include('components.upload-laporan')
            @endif





            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Laporan</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th>Diperiksa Oleh</th>
                        <th>diperiksa Pada</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($laporan as $item)
                    @if(app(AllServices::class)->isLoggedUserHasAdminAccess(auth()->user()->role) || auth()->user()->id == $item->created_by)
                    <tr style="
                            @if($item->status == 'Disetujui') background-color: #def0d8; /* Warna hijau */
                            @elseif($item->status == 'Ditolak') background-color:  #f2dedf; /* Warna merah */
                            @else background-color: #e8f0fe; /* Warna biru */
                            @endif
                            ">

                        <td>
                            <div class="user-panel d-flex">
                                <div class="d-flex align-items-center">
                                    {{$item->nama_laporan}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="d-flex align-items-center">
                                    {{$item->jenisLaporan->nama}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="d-flex align-items-center">
                                    {{$item->status}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="info">
                                    <span>{{ \App\Models\User::find($item->created_by)->name }}
                                        <span class="badge badge-success"
                                            style="margin-left: 5px">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($item->created_by)->role) }}</span>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="info">
                                    @if($item->direview_oleh !== null)
                                    <span>{{ \App\Models\User::find($item->direview_oleh)->name }}
                                        <span class="badge badge-success "
                                            style="margin-left: 5px">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($item->direview_oleh)->role) }}</span>
                                    </span>
                                    @else
                                    <span>Belum Diperiksa</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="d-flex align-items-center">
                                    @php
                                    if($item->status == 'Menunggu') {
                                        echo '-';
                                    } elseif ($item->status == 'Disetujui') {
                                        echo \Carbon\Carbon::parse($item->approve_at)->format('d/m/Y');
                                    } elseif ($item->status == 'Ditolak') {
                                        echo \Carbon\Carbon::parse($item->reject_at)->format('d/m/Y');
                                    }
                                    @endphp
                                </div>
                            </div>
                        </td>


                        <td>
                            <div class="d-flex" style="gap: 5px">
                                <a href="#" target="_blank" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-detail-document"><i class="fas fa-info-circle text-light"></i></button>
                                <button type="button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modal-edit-document" data-id="{{ $item->id }}">
                                    <i class="fas fa-edit text-light"></i>
                                </button>
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
    <!-- Modal Edit -->
    <a href="#modal-edit-document" class="btn btn-success mb-3" data-toggle="modal">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Edit Laporan</span>
</a>

<div class="modal fade" id="modal-edit-document" tabindex="-1" role="dialog" aria-labelledby="modal-edit-document-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-document-label">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="document-form" enctype="multipart/form-data" method="POST" action="{{ route('laporan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="document-name">Nama Laporan</label>
                        <input type="text" class="form-control" id="document-name" name="nama_laporan" required>
                    </div>
                    <div class="form-group">
                        <label for="document-type">Tipe Laporan</label>
                        <select class="form-control" id="document-type" name="id_tipelaporan" required>
                            <option value="">Pilih Tipe Laporan</option>
                            @foreach($tipe_laporan as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama_laporan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="revisi">Revisi:</label>
                        <select class="form-control" id="revisi" name="revisi">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document-file">Dokumen</label>
                        <input type="file" class="form-control-file" id="document-file" name="file" required>
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
