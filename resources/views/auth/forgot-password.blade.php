<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> SPM IT Del - Recover Password</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('dashboard') }}" class="h1"><b>SPM</b> IT Del</a>
        </div>
        <div class="card-body">
{{--            @if(session('toastData') == null || session('toastData')['msg'] == null)--}}
{{--                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>--}}
{{--            @else--}}
{{--                <div class="alert alert-success" role="alert">--}}
{{--                   {{ session('toastData')['msg'] }}--}}
{{--                </div>--}}
{{--            @endif--}}

            @if(session('toastData') == null || !array_key_exists('msg', session('toastData')))
                <p class="login-box-msg">Anda hanya selangkah lagi menuju kata sandi baru Anda, pulihkan kata sandi Anda sekarang.</p>
            @else
                <div class="alert alert-success" role="alert">
                    {{ session('toastData')['msg'] }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="far fa-envelope"></i>
                        </div>
                    </div>
                </div>
                <span class="text-danger">{{ $errors->first('email') }}</span>

                <input type="hidden" name="url" value="{{ \Illuminate\Support\Facades\Request::root() }}">

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reset Kata Sandi</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route("login") }}">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
</body>
</html>


