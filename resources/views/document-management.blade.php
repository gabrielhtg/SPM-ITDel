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


                <a href="{{ route('documentAdd') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Document</span>
                </a>

                @if(app(AllServices::class)->isAdmin())
                    @include('components.upload-document-type')
                @endif
                @if(app(AllServices::class)->isAdmin())
                    @include('components.edit-document-hero')
                              
                @endif


                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>

                        <th>Doc Number</th>
                        <th>Doc Name</th>
                        <th>Doc Type</th>

                        <th>Uploaded By</th>
                        <th>Status</th>
                        <th>Status Aktif</th>
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody>

                    @foreach($documents as $e)
                        @if (
                                app(AllServices::class)->isAdmin() ||
                                auth()->user()->id == $e->created_by ||
                                (
                                    $e->keterangan_status==1 && (
                                        app(AllServices::class)->isUserRole(auth()->user(), $e->give_access_to) ||
                                        app(AllServices::class)->isAllView($e->id) ||
                                        (app(AllServices::class)->isUserRole(auth()->user(), $e->give_edit_access_to) && $e->keterangan_status==1)
                                    )
                                )
                            )
                            <tr>

                                <td>{{ $e->nomor_dokumen }}</td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            {{ $e->name }}
                                        </div>

                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="d-flex align-items-center">
                                            @php
                                                $document = $jenis_dokumen->where('id', $e->tipe_dokumen)->first();

                                            @endphp
                                            {{ $document ? $document->jenis_dokumen : '' }}
                                        </div>
                                    </div>
                                </td>


                                {{-- <td>
                                    <span class="d-block">
                                        @php
                                            $accessor = explode(";", $e->give_access_to);
                                        @endphp

                                        @foreach($accessor as $acc)
                                            <span class="badge badge-primary">
                                                @if($acc == 0)
                                                    All
                                                @else
                                                    {{ \App\Models\RoleModel::find($acc)->role }}
                                                @endif
                                            </span>
                                        @endforeach
                                    </span>
                                </td> --}}

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                        <span> {{ \App\Models\User::find($e->created_by)->name }} <span
                                                class="badge badge-success"
                                                style="margin-left: 5px">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($e->created_by)->role) }}</span></span>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                            @php
                                                if($e->keterangan_status == 0) {
                                                    echo 'Tidak Berlaku';
                                                } else {
                                                    echo 'Berlaku';
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">

                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ asset($e->directory) }}" target="_blank" class="btn btn-success"><i
                                                class="fas fa-eye"></i></a>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            @include('components.detail-file-modal', ['documentId' => $e->id])

                                        @endif

                                        {{-- // jika user sekarang == user yang upload di data Dokumen
                                        // if userSekarang -> id == document->created_by --}}
                                        @if((app(AllServices::class)->isAdmin()) || (auth()->user()->id== $e->created_by)||app(AllServices::class)->isUserRole(auth()->user(), $e->give_edit_access_to))
                                            <a href="{{ route('document.edit', ['id' => $e->id]) }}"
                                               class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        @endif


                                        @if(app(AllServices::class)->isAdmin())
                                            @include('components.delete-confirmation-modal', ['id' => $e->id, 'name' => $e->name, 'route' => 'remove-document'])
                                        @endif

                                    </div>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                @foreach ($documents as $e)
                    <div class="modal fade" id="modal-detail-document-{{ $e->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Dokumen</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama Dokumen:</strong> {{ $e->name}}</p>
                                    <p><strong>Tipe Dokumen:</strong> {{ $e->tipe_dokumen }}</p>
                                    <p><strong>Nomor Dokumen:</strong> {{ $e->nomor_dokumen }}</p>
                                    <p><strong>Tahun:</strong> {{ $e->year }}</p>
                                    <p><strong>User
                                            Upload:</strong> {{ $uploadedUsers->where('id', $e->created_by)->first()->name }}
                                    </p>
                                    <p><strong>Tanggal Dibuat:</strong> {{ $e->created_at }}</p>
                                    <p><strong>Tanggal
                                            Berlaku:</strong> {{ \Carbon\Carbon::parse($e->start_date)->format('d/m/Y') }}
                                        - {{ \Carbon\Carbon::parse($e->end_date)->format('d/m/Y') }}</p>
                                    <p><strong>Status:</strong>
                                        @if($e->status == 0)
                                            Berlaku
                                        @elseif($e->status == 1)
                                            Tidak Berlaku
                                        @endif
                                    </p>
                                    <p><strong>Menggantikan Dokumen:</strong> {{ $e->menggantikan_dokumen }} </p>

                                    <!-- Anda dapat menambahkan atribut tambahan sesuai kebutuhan -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="modal fade" id="modal-edit-document-{{ $e->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Document</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form-edit-document-{{ $e->id }}" enctype="multipart/form-data"
                                          method="POST" action="{{ route('updateDocument', ['id' => $e->id]) }}">
                                        @csrf
                                        @method('POST')

                                        <div class="input-group">
                                            <input type="text" name="name" placeholder="Title" class="form-control"
                                                   required value=" {{ $e->name}}">
                                        </div>

                                        <div class="input-group mt-3">
                                            <select name="status" class="form-control" required>
                                                <option value="" disabled>Select Status</option>
                                                <option value="Berlaku" {{ $e->status === 'berlaku' ? 'selected' : '' }}>
                                                    Berlaku
                                                </option>
                                                <option value="Tidak Berlaku" {{ $e->status === 'tidak berlaku' ? 'selected' : '' }}>
                                                    Tidak Berlaku
                                                </option>
                                            </select>
                                        </div>


                                        <div class="input-group mt-3">
                                            <input type="text" name="nomor_dokumen" placeholder="Document Number"
                                                   class="form-control" required value="{{$e->nomor_dokumen}}">
                                        </div>
                                        <div class="input-group mt-3">
                                            <input type="number" name="year" placeholder="Year" class="form-control"
                                                   required min="1" value="{{ $e->year }}">

                                        </div>

                                        <div class="input-group mt-3">
                                            <select name="tipe_dokumen" class="form-control" required>
                                                <option value="{{$e->tipe_dokumen}}"
                                                        selected>{{ $e->tipe_dokumen }}</option>
                                                <option value="Peraturan Pemerintah">Peraturan Pemerintah</option>
                                                <option value="Statuta IT Del">Statuta IT Del</option>
                                                <option value="Rencana Induk Pengembangan IT Del">Rencana Induk
                                                    Pengembangan IT Del
                                                </option>
                                                <option value="Rencana Strategis IT Del">Rencana Strategis IT Del
                                                </option>
                                                <option value="Rencana Operasional IT Del">Rencana Operasional IT Del
                                                </option>
                                                <option value="Kebijakan Rektor IT Del">Kebijakan Rektor IT Del</option>
                                                <option value="Kebijakan SPMI">Kebijakan SPMI</option>
                                                <option value="Standar SPMI">Standar SPMI</option>
                                                <option value="Manual SPMI">Manual SPMI</option>
                                                <option value="Formulir SPMI">Formulir SPMI</option>
                                                <option value="SOP">SOP</option>
                                                <option value="Instruksi Kerja">Instruksi Kerja</option>
                                                <option value="Artefak AMI">Artefak AMI</option>
                                                <option value="Laporan RTM">Laporan RTM</option>
                                                <option value="Laporan Evaluasi Kepuasan">Laporan Evaluasi Kepuasan
                                                </option>
                                                <option value="Laporan Berkala">Laporan Berkala</option>
                                                <option value="Rencana Strategis Fakultas">Rencana Strategis Fakultas
                                                </option>
                                                <option value="Rencana Operasional Fakultas">Rencana Operasional
                                                    Fakultas
                                                </option>
                                                <option value="Kebijakan Dekan">Kebijakan Dekan</option>
                                                <option value="Dokumen Lainnya">Dokumen Lainnya</option>
                                            </select>
                                        </div>

                                        @php
                                            $selectedRoles = [];
                                            foreach($accessor as $acc) {
                                                if($acc == 0) {
                                                    $selectedRoles[] = '0'; // '0' digunakan untuk nilai "All"
                                                } else {
                                                    $selectedRoles[] = \App\Models\RoleModel::find($acc)->id;
                                                }
                                            }
                                        @endphp

                                        <div class="input-group mt-3">
                                            <select name="give_access_to[]" class="select2 form-control"
                                                    multiple="multiple" data-placeholder="Give Access to"
                                                    style="width: 100%;">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles) ? 'selected' : '' }}>{{ $role->role }}</option>
                                                @endforeach
                                                <option value="0" {{ in_array('0', $selectedRoles) ? 'selected' : '' }}>
                                                    All
                                                </option>
                                            </select>
                                        </div>

                                        <div class="input-group mt-3">
                                            <label for="expried_date">Valid Since:</label>
                                        </div>
                                        <div class="input-group">
                                            <input type="date" id="expried_date" name="expried_date"
                                                   class="form-control" required value="{{ $e->expried_date }}">
                                        </div>
                                        <div class="input-group mt-3">
                                            <input type="file" name="file" value="{{ $e->filename }}">
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" form="form-edit-document-{{ $e->id }}"
                                            class="btn btn-primary">Save Changes
                                    </button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div> --}}
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
