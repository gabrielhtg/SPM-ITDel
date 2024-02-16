<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SPM IT Del</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
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
    <link rel="stylesheet" href="{{ asset("cropper/cropper.min.css") }}">
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
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline d-flex flex-column align-items-center justify-content-center" style="height: 80vh">

                        <div class="d-flex justify-content-center mt-4" >
                            <div style="width: 500px; min-width: 300px; height: 300px;">
                                <img id="image" src="{{ asset("src/img/default-profile-pict.png") }}" alt="gambar" style="height: 200px">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3 flex-column align-items-center">
                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                      data-original-title="Import image with Blob URLs">
                            Upload Image
                        </span>
                            </label>

                            <button id="btnSubmit" class="btn btn-success">Set as Profile Picture</button>
                        </div>

                </div>


            </div>
        </section>
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
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.js") }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("cropper/cropper.js") }}"></script>
<script src="{{ asset("plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // import 'cropperjs/dist/cropper.css';
    const image = document.getElementById('image');
    const cropper = new Cropper(image, {
        aspectRatio: 1,
        guides: true
    });
</script>

<script>
    const gambar = document.getElementById('image');
    const uploadImage = document.getElementById('inputImage');

    uploadImage.addEventListener('change', function () {
        const file = this.files[0]; // Ambil file gambar yang dipilih

        if (file) {
            const reader = new FileReader(); // Buat objek FileReader
            reader.readAsDataURL(file); // Baca file sebagai URL Data

            reader.onload = function () {
                cropper.replace(reader.result);
            }
        }
    });
</script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>

<script>
    const btnSubmit = document.getElementById('btnSubmit');

    btnSubmit.addEventListener('click', function () {
        cropper.getCroppedCanvas({
            width: 500,
            height : 500,g
            minWidth: 256,
            minHeight: 256,
            maxWidth: 4096,
            maxHeight: 4096
        }).toBlob((blob) => {
            const formData = new FormData();

            // Pass the image file name as the third parameter if necessary.
            formData.append('croppedImage', blob/*, 'example.png' */);

            // Use `jQuery.ajax` method for example
            $.ajax('{{ route('uploadProfilePict') }}', {
                method: 'POST',
                headers : {
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Redirect to user-settings page
                    sessionStorage.setItem('success', "1");
                    sessionStorage.setItem('text', 'Successfully changed profile photo.');
                    window.location.href = '{{ route("change-profile-pict") }}';
                },
                error: function(jqXHR, status, error) {
                    if (jqXHR.status === 413) {
                        sessionStorage.setItem('success', "0");
                        sessionStorage.setItem('text', 'The file you uploaded is too large. Please upload files smaller than 2MB.');
                        window.location.href = '{{ route("change-profile-pict") }}';
                    } else {
                        sessionStorage.setItem('success', "0");
                        sessionStorage.setItem('text', 'An error occurred: ' + error);
                        window.location.href = '{{ route("change-profile-pict") }}';
                    }
                }
            });
        });
    });
</script>
<script>
    $(function () {
        if (sessionStorage.getItem('success') != null) {
            if (sessionStorage.getItem('success') === "1") {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: sessionStorage.getItem('text'),
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: sessionStorage.getItem('text'),
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 5000
                });
            }
            sessionStorage.removeItem('success');
        }

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
</body>
</html>
