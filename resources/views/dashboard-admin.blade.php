<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset("plugins/jqvmap/jqvmap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("plugins/daterangepicker/daterangepicker.css") }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("splide/dist/css/splide.min.css") }}">
    
</head>
    <body>
        <div class="wrapper">
            @include('components.navbar')
            @include('components.sidebar')

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="card" style="border: 2px solid rgb(62, 152, 208);margin:40px; padding:40px;">
                    <h4 class="card-header font-weight-bold fs-5">
                        Introduction
                    </h4>
                    <div class="card-body">
                        
                        @include('components.add-dashboard-about')
                        
                        <div class="list-group">
                            <table class="table">
                                <tbody>
                                    
                                @forelse ($dashboard as $item)

                                <div class="container-ann1">
                                    <div class="flex-wrap" style="display: flex; justify-content: space-between; align-items: center;">
                                        <tr>                                    
                                            <td class="align-items-center">
                                                <a href="{{ route('dashboard-introduction-detail', ['id' => $item->id]) }}" class="list-group-item-action" style="flex: 1;">{!! $item->juduldashboard !!}</a>
                                            </td>
                                            <td style="width: 190px;">
                                                <div style="flex-shrink: 4;">
                                                    <button type="button" class="btn btn-warning" style="padding: 5px 15px" data-toggle="modal" data-target="#modal-update-introduction-{{$item->id}}" >
                                                        Update
                                                    </button>

                                                    <div class="modal fade" id="modal-update-introduction-{{$item->id}}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Introduction</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="form-editIntroduction" method="POST" action="{{ route('dashboard-introduction-udpate', ['id' => $item->id]) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        {{-- input title --}}
                                                                        <div class="form-group mt-1">
                                                                            <label for="judul">Judul Berita</label>
                                                                            <input type="text" name="juduldashboard" id="title" class="form-control" value="{!! $item->juduldashboard !!}" required>
                                                                        </div>
                                                
                                                                        {{-- input konten --}}
                                                                        <label for="summernote">Keterangan News</label>
                                                                        <textarea class="summernote" name="keterangandashboard">{!! $item->keterangandashboard !!}</textarea>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" form="form-editIntroduction" class="btn btn-primary">Update Introduction</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                            
                                                    <button type="button" class="btn btn-danger" style="padding: 5px 15px" data-toggle="modal">
                                                        <a href="{{ route('dashboard-introduction-delete', ['id' => $item->id]) }}" style="color: black">Delete</a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>
                                </div>
                                @empty
                                <a href="#" class="list-group-item list-group-item-action">Belum ada data pengumuman</a>
                                @endforelse
            
                                </tbody>
                            </table>
            
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="content-wrapper"> --}}
                {{-- <div class="card"> --}}

                {{-- </div> --}}
            {{-- </div> --}}
            <!-- /.content-wrapper -->
            @include('components.footer')

            <!-- Control Sidebar -->
            {{-- <aside class="control-sidebar control-sidebar-dark"> --}}
                <!-- Control sidebar content goes here -->
            {{-- </aside> --}}
            <!-- /.control-sidebar -->
        </div>



        {{-- --------------------------------------SCRIPT--------------------------------------------- --}}
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
        <!-- Page specific script -->

        {{-- <script>
            document.getElementById('inputGambar').addEventListener('change', function(e) {
                var fileName = document.getElementById('inputGambar').files[0].name;
                var nextSibling = e.target.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        </script> --}}

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
                    text: 'Failed to add news! {!! $errors->first('judul') !!}{!! $errors->first('isinews') !!}{!! $errors->first('gambar') !!}',
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