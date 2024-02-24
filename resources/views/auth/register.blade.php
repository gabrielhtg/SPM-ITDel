@php use App\Services\CustomConverterService; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route("dashboard") }}" class="h1"><b>AMI</b> IT Del</a>
        </div>
        <div class="card-body">

            <p class="login-box-msg">Register a new membership</p>

            <form method="POST" action="{{ route('self-register') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Full name" required>
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
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
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
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                        </div>
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
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Retype password">
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
                            <select name="role" class="select2">
                                <option></option>
                                @foreach($roles as $e)
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endforeach
                            </select>
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
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js")  }}"></script>
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset("plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: "Select role",
            allowClear: true
        });
    })
</script>
</body>
</html>
