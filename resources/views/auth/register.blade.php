<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h2>Registration Form</h2>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-7">
                <input type="text" name="name" id="name" placeholder="Full Name" class="form-control" autofocus>
                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>
                <span style="color: red">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-7">
                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                <span style="color: red">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 control-label">{{ __('Password') }}</label>

            <div class="col-sm-7">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-sm-2 control-label">{{ __('Confirm Password') }}</label>

            <div class="col-sm-7">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-7 col-sm-offset-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">I accept <a href="#">terms</a>
                    </label>
                </div>
            </div>
        </div> <!-- /.form-group -->
        <div class="form-group">
            <div class="col-sm-5 col-sm-offset-3">
                <button id="submit" type="submit" class="btn btn-primary btn-block" disabled>Register</button>
            </div>
        </div>
    </form> <!-- /form -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $("input[type='checkbox']").click(function () {
        if($("input[type='checkbox']").prop('checked') === true) {
            $('#submit').prop('disabled', false);
        }else  $('#submit').prop('disabled', true);
    });

</script>
</body>
</html>