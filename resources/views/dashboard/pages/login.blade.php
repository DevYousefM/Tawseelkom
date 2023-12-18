<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم | تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/style.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">توصيلكم</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">تسجيل الدخول</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control text-right"
                            placeholder="أسم المستخدم">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="col-12 text-right" dir="rtl">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (session()->has('username_error'))
                                <span class="text-danger">{{ session('username_error') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group position-relative">
                        <input type="password" name="password" class="form-control text-right"
                            placeholder="كلمة المرور">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="password-toggle" id="password-toggle">
                            <i class="fa fa-eye-slash">
                            </i>
                        </div>
                        <div class="col-12 text-right" dir="rtl">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (session()->has('password_error'))
                                <span class="text-danger">{{ session('password_error') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('dashboard/dist/js/main.js') }}"></script>

</body>

</html>
