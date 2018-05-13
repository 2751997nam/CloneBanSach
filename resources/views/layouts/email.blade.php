<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <style>
        .main {
            text-align: center;
        }
    </style>
    @yield('css')
</head>
<body>
    <div class="main">
        @yield('logo')
        <h2 style="font-weight: bold">Trang Web Bán Sách Online Lớn Nhất Việt Nam</h2>
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>