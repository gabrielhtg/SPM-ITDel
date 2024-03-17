

{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
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
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    {{--    <link rel="stylesheet" href="{{ asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">--}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include("components.navbar")

@include("components.sidebar")
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Document</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline" style="min-height: 80vh">
                                <div class="card-body">
                                    <form id="form-upload" enctype="multipart/form-data" method="POST" action="{{ route('updateDocument', ['id' => $document->id]) }}">
                                        @csrf

                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" name="name" class="form-control" required value="{{$document->name}}">
                                </div>

                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="keterangan_status" class="form-control" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="1" {{ $document->keterangan_status == 1 ? 'selected' : '' }}>Berlaku</option>
                                        <option value="0" {{ $document->keterangan_status == 0 ? 'selected' : '' }}>Tidak Berlaku</option>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label>Document Number:</label>
                                    <input type="text" name="nomor_dokumen" class="form-control" required value="{{$document->nomor_dokumen}}">
                                </div>

                                <div class="form-group">
                                    <label for="summernote">Description</label>
                                    <textarea class="summernote" name="deskripsi">{!! $document->deskripsi !!}</textarea>
                                </div>
                                

                                <div class="form-group">
                                    <label>Menggantikan Dokumen:</label>
                                    <select name="menggantikan_dokumen[]" class="select2 form-control" multiple="multiple" data-placeholder="Search Document Type" style="width: 100%;">
                                        @foreach($documents as $type)
                                            @if($type->created_by == auth()->user()->id)
                                                <option value="{{ $type->id }}">{{ $type->name }}({{ $type->tipe_dokumen }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>  

                                <div class="form-group">
                                    <label>File:</label>
                                    <input type="file" name="file" class="form-control-file" >
                                </div>

                                <div class="form-group">
                                    <label>Link Document:</label>
                                    <input type="text" name="link" class="form-control" value="{{ $document->link }}">
                                </div>
                                

                                
                                </div>
                            </div>
                        </div>

                        <div class="card-body col-md-6">
                            <div class="card card-primary card-outline" style="min-height: 80vh">
                                <div class="card-body">
                            
                                    <div class="form-group">
                                        <label>Document Type:</label>
                                        <select id="tipe_dokumen"  name="tipe_dokumen" class="select2 form-control" multiple="multiple" data-placeholder="Search Document Type" style="width: 100%;">
                                            @foreach($jenis_dokumen as $type)
                                                @if($document->tipe_dokumen == $type->jenis_dokumen)
                                                <option value="{{ $type->jenis_dokumen }}" selected>{{ $type->jenis_dokumen }}</option>
                                                @else
                                                <option value="{{ $type->jenis_dokumen }}" >{{ $type->jenis_dokumen }}</option>
                                                @endif

                                              
                                            @endforeach
                                        </select>
                                    </div>

                                <div class="form-group">
                                    <label>Give Access to:</label>
                                    <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Give Access to" style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                        <option value="0">All</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Can See By:</label>
                                    <select name="can_see_by" class="form-control" required>
                                        <option value="" disabled>Select Visibility</option>
                                        <option value="1" @if($document->can_see_by == 1) selected @endif>Public</option>
                                        <option value="0" @if($document->can_see_by == 0) selected @endif>Private</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <input type="datetime-local" name="start_date" class="form-control" required value="{{ $document->start_date }}">
                                </div>
                                
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <input type="datetime-local" name="end_date" class="form-control" required value="{{ $document->end_date }}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Year:</label>
                                    <input type="number" name="year" class="form-control" required min="1" value="{{ $document->year }}">
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                    <button type="submit" class="btn btn-primary">Upload Document</button>
                                </div>
                            
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>

<!-- ./wrapper -->

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