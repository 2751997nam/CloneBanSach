<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/components/font-awesome/css/fontawesome-all.css') }}" >
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    @yield('css')
    <meta name="_token" content="{{ csrf_token() }}"/>
</head>
<body>

<div class="main">
    <div style="margin: auto">
    @include('navbar')
    </div>
    <div class="container" style="margin: auto">
    @yield('content')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-tw"></i>
        <br>
        <span>Loading</span>
    </div>
</div>
@include('footer')

<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>

@yield('script')

</body>
</html>
