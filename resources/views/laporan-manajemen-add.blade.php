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
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

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
                        <h1 class="m-0">Manajemen Laporan Berkala</h1>
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
                @include('components.upload-jenis-laporan')
                    <a href="{{ route('viewLaporanJenis') }}" class="btn btn-primary mb-3">
                        <i class="far fa-eye"></i> <span style="margin-left: 5px">Lihat Kategori Tipe Laporan</span>
                    </a>
                @endif




            @if(app(AllServices::class)->haveAccountable(auth()->user()->role) )
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
                        <th>Diperiksa Pada</th>
                        <th>Revisi</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $item)
                    @if(app(AllServices::class)->isLoggedUserHasAdminAccess(auth()->user()->role) || auth()->user()->id === $item->created_by)
                    <tr style="
                            @if($item->status == 'Disetujui') background-color: #def0d8; /* Warna hijau */
                            @elseif($item->status == 'Direview') background-color:  #f2dedf; /* Warna merah */
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
                                    
                                    {{ \App\Services\AllServices::JenislaporanName($item->id_tipelaporan) }}
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
                                    } elseif ($item->status == 'Direview') {
                                        echo \Carbon\Carbon::parse($item->reject_at)->format('d/m/Y');
                                    }
                                    @endphp
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-panel d-flex">
                                <div class="d-flex align-items-center">
                                    @php
                                    if($item->revisi == 1) {
                                        $allServices = new \App\Services\AllServices();
                                        $namaLaporan = $allServices->getNamaLaporanById($item->cek_revisi);
                                        echo $namaLaporan;
                                    }
                                    else if($item->revisi == 0){
                                        echo "Tidak";
                                    }
                                    @endphp
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex" style="gap: 5px">
                                <a href="{{ $item->directory ? asset($item->directory) : '#' }}" target="_blank" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($item->status=="Menunggu" && auth()->user()->id==$item->created_by)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edit-laporan{{$item->id}}">
                                <i class="fas fa-edit"></i> </button>
                                @endif
                                @if((auth()->user()->id === $item->created_by) && ($item->status =="Direview"))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commentModal{{$item->id}}">
                                    <i class="fas fa-comment"></i>
                                </button>
                                @endif


                            </div>
                        </td>


                    </tr>


                    <div class="modal fade" id="modal-edit-laporan{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-edit-laporan-label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-edit-laporan-label">Edit Laporan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="laporan-form{{$item->id}}" enctype="multipart/form-data" method="POST" action="{{ route('laporan.update', ['id' => $item->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="laporan-name">Nama Laporan</label>
                                            <input type="text" id="edit_nama_laporan{{$item->id}}" name="nama_laporan" class="form-control" value="{{ $item->nama_laporan }}">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="edit-tipe-laporan{{ $item->id }}">Tipe Laporan</label>
                                            <select id="edit-tipe-laporan{{ $item->id }}" name="id_tipelaporan" class="edit-tipe-laporan-custom form-control" style="width: 100%">
                                                <option></option>
                                                @foreach($tipe_laporan as $tipe)
                                                    <option value="{{ $tipe->id }}" @if($tipe->id == $item->id_tipelaporan) selected @endif>{{ $tipe->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-revisiCheckbox{{ $item->id }}">Revisi:</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="edit-revisiCheckbox{{ $item->id }}" name="revisi" value="1" {{ $item->revisi == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="edit-revisiCheckbox{{ $item->id }}">Ya</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3" style="display: none;">
                                            <label for="edit-menggantikan{{ $item->id }}">Merevisi Laporan:</label>
                                            <select id="edit-menggantikan{{ $item->id }}" name="cek_revisi" class="edit-menggantikan form-control" style="width: 100%">
                                                <option></option>
                                                @php
                                                $allServices = new \App\Services\AllServices();
                                                @endphp
                                                @foreach ($laporan as $lap)
                                                    @if(auth()->user()->id == $lap->created_by && $lap->status=="Revisi" && $allServices->isLaporanIdInCekLaporan($lap->id))
                                                        <option value="{{$lap->id}}" @if($item->revisi == $lap->cek_revisi) selected @endif>{{$lap->nama_laporan}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="laporan-file">Dokumen</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="edit-laporan-file{{$item->id}}" name="file">
                                                    <label class="custom-file-label" for="edit-laporan-file{{$item->id}}">
                                                        @if($item->directory)
                                                            {{ basename($item->directory) }}
                                                        @else
                                                            Pilih file
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="commentModal{{$item->id}}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Isi Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tempat untuk menampilkan isi komentar -->
                <div id="commentContent">
                    {{$item->komentar}}
                </div>
                <!-- Tautan untuk melihat file komentar dalam tab baru -->
                <div>

                    @if($item->file_catatan)
                        <a href="{{ asset($item->file_catatan) }}" target="_blank" class="btn btn-success">
                            <i class="fas fa-eye"></i> Lihat File
                        </a>
                    @else
                        <span class="text-muted">Tidak ada file komentar.</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



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
            "order": [[2, "desc"]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

<script>
    // Script JavaScript untuk menangani perubahan checkbox revisi
    document.addEventListener("DOMContentLoaded", function() {
        @foreach ($laporan as $item)
           @if($item->status=="Menunggu")
           var checkbox{{ $item->id }} = document.getElementById("edit-revisiCheckbox{{ $item->id }}");
            var merevisiLaporan{{ $item->id }} = document.getElementById("edit-menggantikan{{ $item->id }}").parentNode;

            checkbox{{ $item->id }}.addEventListener('change', function() {
                if (checkbox{{ $item->id }}.checked) {
                    merevisiLaporan{{ $item->id }}.style.display = 'block';
                    document.getElementById("edit-menggantikan{{ $item->id }}").setAttribute('required', 'required');
                } else {
                    merevisiLaporan{{ $item->id }}.style.display = 'none';
                    document.getElementById("edit-menggantikan{{ $item->id }}").removeAttribute('required');
                }
            });
            @endif
        @endforeach

    });
</script>
<script>
        $(function() {
            //Initialize Select2 Elements
            $('.tipe-laporan-custom').select2({
                placeholder: "Pilih Tipe Laporan",
            });
            $('.menggantikan-to-custom').select2({
                placeholder: "Pilih Revisi",
            });
            $('.edit-tipe-laporan-custom').select2({
                placeholder: "Pilih Tipe Laporan",
            });
            $('.edit-menggantikan').select2({
                placeholder: "Pilih Revisi",
            });
        })
    </script>




</body>
</html>
