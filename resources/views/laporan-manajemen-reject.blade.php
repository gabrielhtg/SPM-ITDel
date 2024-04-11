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
                    @php
                    $isResponsible = app(AllServices::class)->isAccountable(auth()->user()->role);
                   
                @endphp
                
                
                @if($isResponsible)
                    @include('components.list-document-pending-modal')
                    @include('components.upload-jenis-laporan')
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
                        {{-- @php
                        dd((app(AllServices::class)->isAccountableToRole(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by))));
                        dd((app(AllServices::class)->getRoleName(auth()->user()->role))===(app(AllServices::class)->getAllResponsible(app(AllServices::class)->getUserRoleById(5))));
                        @endphp --}}
                        @if((app(AllServices::class)->isAccountableToRole(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by)))||(app(AllServices::class)->isResponsibleToRole(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by)))||(app(AllServices::class)->isInformableToRole(auth()->user()->role,app(AllServices::class)->getUserRoleById($item->created_by))))
                        <tr style="
                                @if($item->status === 'Disetujui') background-color: #def0d8; /* Warna hijau */
                                @elseif($item->status === 'Ditolak') background-color:  #f2dedf /* Warna merah */
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
                                        {{$item->JenisLaporan->nama}}
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
    