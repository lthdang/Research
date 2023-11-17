<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/icon-set/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/ckeditor.css')}}"  rel="stylesheet">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css?v=1.0')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{asset('assets/css/custom.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row">
        @include('layouts.partials.navbar')
    </div>
    <div class=" flex-grow-1">
        <div class="container ">
            @yield('content')
        </div>
    </div>
    <div class="row">
        @include('layouts.partials.footer')
    </div>
</div>
<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</body>
</html>
