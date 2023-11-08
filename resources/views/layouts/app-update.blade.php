<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>

    <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/icon-set/style.css')}}">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css?v=1.0')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{asset('assets/css/custom.css') }}" rel="stylesheet">

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#success-alert').fadeOut('fast');
            }, 3000);
        });
    </script>
</head>
<body>
@include('layouts.partials.navbar')
<div class="container">
    @yield('content')
</div>

@include('layouts.partials.footer')
<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
