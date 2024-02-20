@php use App\Services\CustomConverterService; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Announcement</title>

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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include("components.navbar" )
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
                        <h1 class="m-0">Announcement</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">

                @include('components.add-announcement')

                <div class="list-group">

                    <table class="table table-hover">
                        {{-- <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead> --}}
                        <tbody>

                    @forelse ($announcement as $item)

                    <div class="container-ann1">
                        <div class="flex-wrap" style="display: flex; justify-content: space-between; align-items: center;">

                            
                                  <tr>
                                    {{-- <th scope="row">1</th> --}}
                                    
                                    <td class="align-items-center">
                                        <a href="{{ route('announcement.detail', ['id' => $item->id]) }}" class="list-group-item-action" style="flex: 1;">{{ $item->title }}</a>
                                    </td>

                                  
                                
                            <td style="width: 190px;">
                            <div style="flex-shrink: 4;">
                                <button type="button" class="btn btn-warning" style="padding: 5px 15px" data-toggle="modal" data-target="#modal-update-announcement-{{$item->id}}" >
                                    Update
                                </button>

                                <div class="modal fade" id="modal-update-announcement-{{$item->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Announcement</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form-updateAnnouncement" method="POST" action="/updateannouncement/{{$item->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Judul" required autofocus autocomplete="title" value="{{$item->title}}">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-heading"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="input-group mt-3">
                                                        <textarea name="content" id="content" cols="10" rows="4" class="form-control" placeholder="Konten" required autofocus autocomplete="content"> {{$item->content}}</textarea>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"> 
                                                                <span class="fas fa-newspaper"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="input-group mt-3">
                                                        <div class="custom-file">
                                                            <input name="file" id="file" type="file" class="custom-file-input" >
                                                            <label class="custom-file-label" for="file"></label>  
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Unggah</span>
                                                        </div>
                                                    </div>
                                                </form>                
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" form="form-updateAnnouncement" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            
                                <button type="button" class="btn btn-danger" style="padding: 5px 15px" data-toggle="modal">
                                    <a href="/deleteannouncement/detail/{{$item->id}}" style="color: black">Delete</a>
                                </button>
                            </td>
                        </tr>
                            </div>
                        </div>
                    </div>
                    {{-- <a  class="list-group-item list-group-item-action">{{ $item->title }}</a> --}}
                    @empty
                    <a href="#" class="list-group-item list-group-item-action">Belum ada data pengumuman</a>
                    @endforelse

                </tbody>
            </table>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<!-- Page specific script -->

<script>
    document.getElementById('file').addEventListener('change', function(e) {
        var fileName = document.getElementById('file').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
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
