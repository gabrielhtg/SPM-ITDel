@php
    $active_sidebar = [1, 0, 0]; // contoh definisi variabel
@endphp
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
                            <h1 class="m-0">Struktur Organisasi SPM Institut Teknologi Del</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="card vh-100" >
                <div class="card-body d-flex justify-content-center">
                    <div id="svg-tree" class="w-100"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.content -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="modal-content">
                            <img id="modal-image" src="" alt="" style="max-width: 100%; height: auto;">
                            <p id="modal-name"></p>
                            <p id="modal-role"></p> 
                            <p id="modal-responsible"></p> 
                            <p id="modal-informable"></p> 
                            <p id="modal-accountable"></p> 
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
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
    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("dist/js/adminlte.min.js") }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/apextree"></script>

    <script>
        const data = {!! $tree !!};
        const arrayResponsibleTo = {!! json_encode($arrayResponsibleTo) !!};
        const options = {
            contentKey: 'data',
            width: '100%',
            height: '650px',
            nodeWidth: 150, 
            nodeHeight: 100,
            fontColor: '#fff',
            borderColor: '#333',
            childrenSpacing: 50,
            siblingSpacing: 20,
            direction: 'top',
            nodeTemplate: (content) =>
                `<a href="#" class="node-link" data-toggle="modal" data-target="#personModal" data-name="${content.name}" data-images="${content.imageURL}" data-role="${content.role}" data-responsible="${content.responsible}" data-informable="${content.informable}" data-accountable="${content.accountable}">
                    <div style='display: flex;flex-direction: column;justify-content: center;align-items: center;height: 100%;'>
                        <img style='width: 50px;height: 50px;border-radius: 50%;' src='${content.imageURL}' alt='' />
                        <div style="font-weight: bold; font-size: 14px">${content.name}</div>
                        <div style="font-weight: bold; font-size: 14px">${content.role}</div>
                    </div>
                </a>`,

            canvasStyle: 'border: 1px solid black;background: #fff;',
        };
        const tree = new ApexTree(document.getElementById('svg-tree'), options);
        tree.render(data);

        // Handle click event for node
        document.querySelectorAll('.node-link').forEach(link =>{
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const name = this.dataset.name;
                const image = this.dataset.images;
                const role = this.dataset.role;
                const responsible = this.dataset.responsible;
                const informable = this.dataset.informable;
                const accountable = this.dataset.accountable;

                // Open modal
                $('#personModal').modal('show');
                $('#modal-name').text(name);
                $('#modal-image').attr('src', image);
                $('#modal-role').text(`Role: ${role}`);
                $('#modal-responsible').text(`Responsible to: ${responsible}`);
                $('#modal-informable').text(`Informable to: ${informable}`);
                $('#modal-accountable').text(`Accountable to: ${accountable}`);
            });
        });

    </script>


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
    document.getElementById('inputGambar').addEventListener('change', function (e) {
        var fileName = document.getElementById('inputGambar').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script> --}}

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
{{-- 
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
</script> --}}
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote({
            // placeholder: 'desc...',
            minHeight: 230,
            // disableDragAndDrop: true,
        })
    })
</script>
</body>
</html>
