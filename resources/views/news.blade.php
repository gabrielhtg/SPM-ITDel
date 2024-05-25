@php use App\Services\AllServices; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News</title>

    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>
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
                        <h1 class="m-0">News</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-body">

                @if(AllServices::isLoggedUserHasAdminAccess())
                    @include('components.add-news')
                @endif

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-wrap">No. </th>
                            <th class="text-wrap">Judul Berita</th>
                            <th class="text-wrap">Tanggal Berlaku</th>
                            <th class="text-wrap">Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $i = 1;
                        @endphp

                        @foreach($news as $e)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="text-wrap">
                                    <div class="d-flex flex-column">
                                        <div class="text-wrap">
                                            {{ $e->title }}
                                        </div>
                                    </div>
                                </td>

                                <td class="text-wrap">
                                    <div class="d-flex flex-column">
                                        <div class="text-wrap">
                                            {{ \Carbon\Carbon::parse($e->start_date)->format('d/m/Y') }}
                                            @if($e->end_date != null)
                                            - {{ \Carbon\Carbon::parse($e->end_date)->format('d/m/Y') }}
                                            @else
                                            - Sekarang
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="text-wrap">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('news.detail', ['id' => $e->id]) }}" method="GET" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $e->id }}">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-external-link-alt"></i></button>
                                            </form>
                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#modal-update-news-{{$e->id}}"><i class="fas fa-pen"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $e->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Delete Confirmation -->
                            <div class="modal fade" id="modal-delete-{{ $e->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-delete-{{ $e->id }}" method="POST" action="{{ route('deletenews', ['id' => $e->id]) }}">
                                                @csrf
                                                @method('GET')
                                                <input type="hidden" name="id" value="{{ $e->id }}">
                                            </form>

                                            <p>Apakah Anda yakin ingin menghapus berita {{ $e->title }}?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" form="form-delete-{{ $e->id }}" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update News -->
                            <div class="modal fade" id="modal-update-news-{{$e->id}}">
                                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Sunting Berita</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-editNews-{{ $e->id }}" method="POST" action="{{ route('updatenews')}}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $e->id }}">

                                                <!-- Input Title -->
                                                <div class="form-group mt-1">
                                                    <label for="judul">Judul Berita</label>
                                                    <input type="text" name="title" id="title" class="form-control" value="{{ $e->title }}">
                                                </div>

                                                <!-- Input Description -->
                                                <label for="summernote">Keterangan Berita</label>
                                                <textarea class="summernote form-control" name="description">{!! $e->description !!}</textarea>

                                                <!-- Input File -->
                                                <div class="form-group">
                                                    <label for="bgimage">Gambar Berita</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="bgimage" name="bgimage">
                                                            <label class="custom-file-label" for="bgimage">{{ $e->bgimage }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Input Time -->
                                                <div class="form-group">
                                                    <label>Tanggal Mulai</label>
                                                    <input type="datetime-local" name="start_date" class="form-control" value="{{ $e->start_date }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tanggal Berakhir</label>
                                                    <input type="datetime-local" name="end_date" class="form-control" value="{{ $e->end_date }}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" form="form-editNews-{{ $e->id }}" class="btn btn-primary">Sunting</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
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
<script src="{{ asset("plugins/datatables/jquery.dataTables.min.js") }}"></script>
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
    let table = new DataTable('#example1', {
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 10,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

<script>
    document.getElementById('bgimage').addEventListener('change', function(e) {
        var fileName = document.getElementById('bgimage').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
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
            showConfirmButton: false,
            timer: 3000
        })
        @else
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: '{!! session('toastData')['text'] !!}',
            showConfirmButton: false,
            timer: 5000
        })
        @endif
        @endif

        @if (!$errors->isEmpty())
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Failed to add news! {!! $errors->first('judul') !!}{!! $errors->first('isinews') !!}{!! $errors->first('gambar') !!}',
            showConfirmButton: false,
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
        })
    })
</script>

</body>
</html>
