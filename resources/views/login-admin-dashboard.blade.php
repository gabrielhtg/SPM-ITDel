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
    <link rel="stylesheet" href="{{ asset("src/css/custom1.css") }}">
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
            <div class="card vh-100" style="margin-bottom: 50px">
                    <div id="svg-tree" class="w-100"></div>
                    <div id="svg-tree2" class="w-100"></div>
            </div>
        </div>
        <div>
            @include('components.footer')
        </div>

        <!-- Modal -->
        <div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Menambahkan kelas modal-lg untuk membuat modal lebih besar -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content">
                            <p id="modal-role">Role: </p> <!-- Mengisi dengan data -->
                            <p id="modal-responsible">Responsible: </p> <!-- Mengisi dengan data -->
                            <p id="modal-informable">Informable: </p> <!-- Mengisi dengan data -->
                            <p id="modal-accountable">Accountable: </p> <!-- Mengisi dengan data -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset("dist/js/adminlte.min.js") }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/apextree"></script>
    {{-- <script src="{{ asset("dist/js/adminlte.min.js") }}"></script> --}}

    <script>
        const data = {!! $tree !!};
        const arrayResponsibleTo = {!! json_encode($arrayResponsibleTo) !!};
        const options = {
            contentKey: 'data',
            width: '100%',
            height: '680px',
            nodeWidth: 120,
            nodeHeight: 40,
            fontColor: '#fff',
            borderColor: '#fff',
            childrenSpacing: 50,
            siblingSpacing: 20,
            direction: 'top',
            nodeTemplate: (content) =>
            `<a href="#" class="node-link" data-toggle="modal" data-target="#personModal" data-name="${content.name}" data-images="${content.imageURL}" data-role="${content.role}" data-responsible="${content.responsible}" data-informable="${content.informable}" data-accountable="${content.accountable}">
                <div class="node-content">
                    <div class="role">${content.role}</div>
                </div>
            </a>`,


            canvasStyle: 'background: #fff;',
        };
        const tree = new ApexTree(document.getElementById('svg-tree'), options);
        tree.render(data);

        // Handle click event for node
        document.querySelectorAll('.node-link').forEach(link =>{
            link.addEventListener('click', function(event) {
                event.preventDefault();
                // const name = this.dataset.name;
                const image = this.dataset.images;
                const role = this.dataset.role;
                const responsible = this.dataset.responsible;
                const informable = this.dataset.informable;
                const accountable = this.dataset.accountable;

                // Open modal
                $('#personModal').modal('show');
                // $('#modal-name').text(`name: ${name}`);
                $('#modal-image').attr('src', image);
                $('#modal-role').text(`Role: ${role}`);
                $('#modal-responsible').text(`Responsible to: ${responsible}`);
                $('#modal-informable').text(`Informable to: ${informable}`);
                $('#modal-accountable').text(`Accountable to: ${accountable}`);
            });
        });

    </script>

    <script>
        const data2 = {
                id: 'ms',
                data: {
                    imageURL: 'https://i.pravatar.cc/300?img=68',
                    name: 'Margret Swanson',
                },
                options: {
                    nodeBGColor: '#cdb4db',
                    nodeBGColorHover: '#cdb4db',
                },
                children: [
                    {
                        id: 'mh',
                        data: {
                            imageURL: 'https://i.pravatar.cc/300?img=69',
                            name: 'Mark Hudson',
                        },
                        options: {
                            nodeBGColor: '#ffafcc',
                            nodeBGColorHover: '#ffafcc',
                        },
                        children: [
                            {
                                id: 'kb',
                                data: {
                                    imageURL: 'https://i.pravatar.cc/300?img=65',
                                    name: 'Karyn Borbas',
                                },
                                options: {
                                    nodeBGColor: '#f8ad9d',
                                    nodeBGColorHover: '#f8ad9d',
                                },
                            },
                            {
                                id: 'cr',
                                data: {
                                    imageURL: 'https://i.pravatar.cc/300?img=60',
                                    name: 'Chris Rup',
                                },
                                options: {
                                    nodeBGColor: '#c9cba3',
                                    nodeBGColorHover: '#c9cba3',
                                },
                            },
                        ],
                    },
                    {
                        id: 'cs',
                        data: {
                            imageURL: 'https://i.pravatar.cc/300?img=59',
                            name: 'Chris Lysek',
                        },
                        options: {
                            nodeBGColor: '#00afb9',
                            nodeBGColorHover: '#00afb9',
                        },
                        children: [
                            {
                                id: 'Noah_Chandler',
                                data: {
                                    imageURL: 'https://i.pravatar.cc/300?img=57',
                                    name: 'Noah Chandler',
                                },
                                options: {
                                    nodeBGColor: '#84a59d',
                                    nodeBGColorHover: '#84a59d',
                                },
                            },
                            {
                                id: 'Felix_Wagner',
                                data: {
                                    imageURL: 'https://i.pravatar.cc/300?img=52',
                                    name: 'Felix Wagner',
                                },
                                options: {
                                    nodeBGColor: '#0081a7',
                                    nodeBGColorHover: '#0081a7',
                                },
                            },
                        ],
                    },
                ],
            };
        const options2 = {
            contentKey: 'data',
            width: 800,
            height: 600,
            nodeWidth: 150,
            nodeHeight: 100,
            fontColor: '#fff',
            borderColor: '#333',
            childrenSpacing: 50,
            siblingSpacing: 20,
            direction: 'top',
            nodeTemplate: (content) =>
                `<div style='display: flex;flex-direction: column;gap: 10px;justify-content: center;align-items: center;height: 100%;'>
          <img style='width: 50px;height: 50px;border-radius: 50%;' src='${content.imageURL}' alt='' />
          <div style="font-weight: bold; font-family: Arial; font-size: 14px">${content.name}</div>
         </div>`,
            canvasStyle: 'border: 1px solid black;background: #f6f6f6;',
            enableToolbar: true,
        };
        const tree2 = new ApexTree(document.getElementById('svg-tree2'), options2);
        tree2.render(data2);
    </script>

<!-- Page specific script -->
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
