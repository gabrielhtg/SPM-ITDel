@php
    $active_sidebar = [1, 0, 0]; // contoh definisi variabel
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        @include('components.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apextree"></script>
    <script>
        const data = {!! $tree !!};
        const options = {
            contentKey: 'data',
            width: '100%',
            height: '500px',
            nodeWidth: 150,
            nodeHeight: 100,
            fontColor: '#000',
            borderColor: '#333',
            childrenSpacing: 50,
            siblingSpacing: 20,
            direction: 'top',
            nodeTemplate: (content) =>
                `<div style='display: flex;flex-direction: column;gap: 10px;justify-content: center;align-items: center;height: 100%;'>
              <img style='width: 50px;height: 50px;border-radius: 50%;' src='${content.imageURL}' alt='' />
              <div style="font-weight: bold; font-size: 14px">${content.name}</div>
             </div>`,
            canvasStyle: 'border: 1px solid black;background: #f6f6f6;',
        };
        const tree = new ApexTree(document.getElementById('svg-tree'), options);
        tree.render(data);
    </script>
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
    <!-- Page specific script -->
</body>
</html>
