@php use App\Services\CustomConverterService; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <!-- Roles -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" >
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route("dashboard") }}" class="h1"><b>AMI</b> IT Del</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form method="POST" action="/register-invite">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email" value="{{ isset($email) ? $email : '' }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-append">
                            </div>
                            <select name="role" id="role" class="form-control" placeholder="Choose roles">
                                <option></option>
                                <option value="Alabama">Alabama</option>
                                <option value="California">California</option>
                                <option value="Delaware">Delaware</option>
                                <option value="Tennessee">Tennessee</option>
                                <option value="Tovas">Tovas</option>
                            </select>
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#role').select2({
            placeholder: 'Choose roles',
            allowClear: true
        });
    });
</script>
</body>
</html>
