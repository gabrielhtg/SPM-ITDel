{{-- @php use App\Models\User;use App\Services\AllServices; @endphp --}}
@php use App\Services\AllServices; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>

    {{-- @php
    dd($documenthero);
    @endphp --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>
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
                        <h1 class="m-0">Kategori Tipe Laporan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">
                <a href="{{ route('LaporanManagementAdd') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-arrow-left"></i> <span style="margin-left: 5px">Kembali</span>
                </a>


                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Kategori Tipe Laporan</th>
                        <th>Tahun</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jenis_laporan as $e)   
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="d-flex align-items-center">
                                        {{ \App\Services\AllServices::getJenislaporanName($e->id_tipelaporan, $e->id) }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="d-flex align-items-center">
                                        {{ $e->year }}
                                    </div>
                                </div>
                            </td><td>
                                <div class="user-panel d-flex">
                                    <div class="d-flex align-items-center">
                                        {{ $e->end_date }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex" style="gap: 5px">
                                    <a data-target="#modal-edit-{{ $e->id }}" class="btn btn-success" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('deleteTypeLaporan', ['id' => $e->id]) }}" style="display: inline-block;">
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @foreach($jenis_laporan as $e)
            @php
                // Misal string "Laporan Bulanan(Pemerintah)"
                $nama_laporan = $e->nama;

                // Cari indeks kurung buka dan kurung tutup
                $pos_buka = strpos($nama_laporan, '(');
                $pos_tutup = strpos($nama_laporan, ')');

                // Ambil teks di antara kurung jika ditemukan
                $value_dalam_kurung = '';
                if ($pos_buka !== false && $pos_tutup !== false) {
                    $value_dalam_kurung = substr($nama_laporan, $pos_buka + 1, $pos_tutup - $pos_buka - 1);
                }
            @endphp
            <!-- Modal Edit -->
            <div class="modal fade" id="modal-edit-{{ $e->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Kategori Tipe Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('editJenisLaporan', ['id' => $e->id]) }}">
                                @csrf
                                <!-- Input fields untuk mengedit -->
                                <div class="form-group">
                                    <label for="edit_id_tipelaporan">Tipe Laporan:</label>
                                    <select class="form-control" id="edit_id_tipelaporan" name="id_tipelaporan" required>
                                        <option value="">Pilih Tipe Laporan</option>
                                        @foreach($type_laporan as $tipe)
                                            <option value="{{ $tipe->id }}" {{ $tipe->id == $e->id_tipelaporan ? 'selected' : '' }}>{{ $tipe->nama_laporan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_nama">Kategori Tipe Laporan:</label>
                                    <input type="text" id="edit_nama" name="nama" class="form-control" value="{{ $e->nama}}" >
                                </div>
                                <div class="form-group">
                                    <label for="Year">Tahun :</label>
                                    <input type="number" id="year" name="year" class="form-control" min="1900" max="20909" step="1" required value="{{$e->year}}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_end_date">Tanggal Berakhir:</label>
                                    <input type="datetime-local" id="edit_end_date" name="end_date" class="form-control" value="{{ $e->end_date }}" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach
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
            "order": [[2, "desc"]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
</div>

</body>
</html>
