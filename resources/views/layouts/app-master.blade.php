<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{!! url('assets/css/custom.css') !!}" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<div class="container ">
    <div class="row">
        <div class="col-lg-2">
            @yield('category')
        </div>
        <div class="col-lg-9">
            <div class="row">
                <article class="carousel slide my-4">
                    @yield('content')
                </article>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.footer')
<script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

</body>
</html>
