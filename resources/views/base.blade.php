<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">

    <title>Hello, world!</title>
</head>
<body>

    @include('layer.navmenu');

<div class="container">

    @include('layer.flash-message')

    @yield('content')

</div>
    @include('layer.footer')

    @include('layer.script')
</body>
</html>