<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>

<!------ Include the above in your HEAD tag ---------->
<div class="navbarN">
    <div class="navbar-top">
        <ul >
            <div class="navbar-top-left">
                <li class="navbar-link"><a href="javascript:void(0)">Tải Ứng Dụng</a></li>
                <li class="navbar-link"><a href="javascript:void(0)">Kết Nối</a>
                    <a href="javascript:void(0)"><i class="fab fa-facebook-square"></i></a>
                    <a href="javascript:void(0)"><i class="fab fa-twitter-square"></i></a>
                </li>
            </div>
            <div class="navbar-top-right">
                <li class="navbar-link"><a href="javascript:void(0)"><i class="far fa-bell"></i>Thông Báo</a></li>
                <li class="navbar-link"><a href="javascript:void(0)"><i class="far fa-question-circle"></i>Trợ Giúp</a></li>
                <li class="navbar-link"><a href="{{ route('register') }}">Đăng Ký</a></li>
                <li class="navbar-link"><a href="{{ route('login')}}">Đăng Nhập</a></li>
            </div>
        </ul>
    </div>
    <div class="navbar-content">
        <a style="margin-left: 15px" href="{{ route('index') }}"><img src="/logo.png" alt="logo" width="50px" height="50px"></a>
    </div>
</div>
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <h2>Đổi Mật Khẩu</h2>
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('Email') }}</label>
            <div class="col-sm-7">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" style="color: red">
                        <strong>{{ $errors->first('email') }}</strong>
                     </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-sm-7">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="color: red">
                        <strong>{{ $errors->first('password') }}</strong>
                     </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-sm-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-sm-7">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5 col-sm-offset-3">
                <button id="submit" type="submit" class="btn btn-primary btn-block" >Gửi</button>
            </div>
        </div>
    </form> <!-- /form -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>