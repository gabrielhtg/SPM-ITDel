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
    <style>
        .required-label::after {
            content: ' *';
            color: red;
            
            font-weight: bold;
        }
    </style>
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
                        <h1 class="m-0">Tambahkan Dokumen</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="align-items-center">
                        <div>
                            <div class="card card-primary card-outline" style="min-height: 80vh">
                                <div class="card-body">
                            <form id="form-upload" enctype="multipart/form-data" method="POST" action="{{ route('uploadFile') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="required-label">Judul:</label>
                                    <input type="text" name="name" class="form-control" required data-toggle="tooltip" data-placement="right" title="Masukkan judul laporan Anda di sini.">
                                </div>
                                



                                <div class="form-group">
                                    <label  class="required-label">Nomor Dokumen:</label>
                                    <input type="text" name="nomor_dokumen" class="form-control" required data-toggle="tooltip" title="Masukkan Nomor dokumen dokumen yang ingin dibuat.">
                                </div>

                                <div class="form-group">
                                    <label for="summernote"  class="required-label">Deskripsi</label>
                                    <textarea class="summernote" name="deskripsi" data-toggle="tooltip" title="Masukkan deskripsi dari dokumen yang ingin dibuat."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Menggantikan Dokumen:</label>
                                    <select name="menggantikan_dokumen[]" class="select2 form-control" multiple="multiple" data-placeholder="Cari Dokumen yang ingin Digantikan" style="width: 100%;" data-toggle="tooltip" title="Cari Dokumen yang ingin digantikan. Pastikan Tipe Dokumen yang diganti sama dengan dokumen yang ingin dibuat.">
                                        @foreach($documents as $type)
                                            @php
                                                // Periksa apakah dokumen sudah digantikan
                                                $isReplaced = App\Models\DocumentModel::where('menggantikan_dokumen', $type->id)->exists();
                                            @endphp
                                            @if($type->created_by == auth()->user()->id && !$isReplaced) <!-- Tampilkan hanya jika dokumen belum digantikan -->
                                                @php
                                                    $document = $jenis_dokumen->where('id', $type->tipe_dokumen)->first();
                                                @endphp
                                                <option value="{{ $type->id }}">{{ $type->name }} {{ $document ? '('.$document->jenis_dokumen.')' : '' }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>File:</label>
                                    <input type="file" name="file" class="form-control-file" >
                                </div>

                                <div class="form-group">
                                    <label>Link Dokumen:</label>
                                    <input type="text" name="link" class="form-control" data-toggle="tooltip" title="Masukkan Link dokumen jika dokumen bisa diakses dari link.">
                                </div>

                                    <div class="form-group">
                                        <label  class="required-label">Tipe Dokumen:</label>
                                        <select id="tipe_dokumen"  name="tipe_dokumen" class="select2 form-control" multiple="multiple" data-placeholder="Cari Tipe Dokumen" style="width: 100%;" data-toggle="tooltip" title="Pilih tipe dokumen yang ingin dibuat.">
                                            @foreach($jenis_dokumen as $type)
                                                <option value="{{ $type->id }}">{{ $type->jenis_dokumen }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                <div class="form-group">
                                    <label  class="required-label">Berikan Akses Kepada:</label>
                                    <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Berikan Akses Kepada" style="width: 100%;" data-toggle="tooltip" title="Pilih role apa saja yang akan menerima atau dapat mengakses dokumen ini.">
                                        <option value="0">Public</option>
                                        @foreach($roles as $role)

                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label  class="required-label">Berikan Izin Edit Kepada:</label>
                                    <select name="give_edit_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Berikan Izin pengeloaan dokumen Kepada" style="width: 100%;" data-toggle="tooltip" title="Pilih role apa saja  yang dapat mengelola dokumen yang anda buat.">

                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label  class="required-label">Dapat Dilihat Oleh:</label>
                                    <select name="can_see_by" class="form-control" required data-toggle="tooltip" title="Tentukan apabila dokumen ini dapat diakses oleh pengguna umum, tentukan apakah isi dokumen dapat dilihat atau tidak.">
                                        <option value="" disabled selected>Pilih Visabilitas</option>
                                        <option value="1">Publik</option>
                                        <option value="0">Pribadi</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label  class="required-label">Dokumen SPM</label>
                                    <select name="dokumen_spm" class="form-control" required data-toggle="tooltip" title="Tentukan apakah dokumen ini termasuk kedalam dokumen SPM atau tidak.">
                                        <option value="" disabled selected>Pilih Opsi</option>
                                        <option value="1">Iya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label  class="required-label">Tanggal Ditetapkan:</label>
                                    <input type="datetime-local" name="set_date" class="form-control" required data-toggle="tooltip" title="Tentukan kapan dokumen ini dibuat atau ditetapkan.">
                                </div>

                                <div class="form-group">
                                    <label  class="required-label">Tanggal Mulai:</label>
                                    <input type="datetime-local" name="start_date" class="form-control" required data-toggle="tooltip" title="Tentukan kapan dokumen ini bisa diakses oleh setiap role yang memiliki akses">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Berakhir:</label>
                                    <input type="datetime-local" name="end_date" class="form-control" placeholder="Pilih tanggal dan waktu" data-toggle="tooltip" title="Tentukan sampai kapan dokumen yang ingin di unggah berlaku sampai kapan">
                                </div>



                                <div class="form-group">
                                    <label  class="required-label">Tahun:</label>
                                    <input type="number" name="year" class="form-control" required min="1" data-toggle="tooltip" title="Tentukan Tahun dari pembuatan dokumen yang ingin di unggah.">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='{{ route('documentManagement') }}'">Kembali</button>

                                    <button type="submit" class="btn btn-primary">Unggah Dokumen</button>
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
            placeholder: "Cari Tipe Dokumen",
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
