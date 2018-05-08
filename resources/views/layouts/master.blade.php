<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('vendor/components/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    @yield('css')
    <meta name="_token" content="{{ csrf_token() }}"/>
</head>
<body>

<div class="main">
    @include('navbar')
    <div class="container">
    @yield('content')
    </div>
</div>
@include('footer')

<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>

@yield('script')

</body>
</html>
