<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href=" {{asset('css/mycss.css')}} ">

    @yield('css')

</head>
<body>
<nav class="navbar fixed-top bg-info"  style="width: 1600px; margin: auto">
    <a class="navbar-brand" href="{{ route('admin.index') }}"><img src="logo_2.png" alt="logo" style="width: 33px"></a>
    <div style="display: table-cell; height: 50px; vertical-align: middle;">
        <p style="margin: 0">Xin Chào {{ \Illuminate\Support\Facades\Auth::user()->name }}!</p>
    </div>
    @yield('nav')
</nav>
<div style="margin: auto; width: 1600px">
@yield('content')
</div>
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
@yield('script')
</body>
</html>