@extends('layouts.auth-master')
@section('title','Blog-Login')
@section('content')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Styles -->
    <form method="post" action="{{url('captcha-validation')}}">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <img class="mb-4" src="{!! url('images/blog.svg') !!}" alt="" width="250" height="100">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        @include('layouts.partials.messages')
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username"
                   required="required" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                   placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group mt-4 mb-4">
            <div class="captcha">
                <span id="captcha-img">{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    ↻
                </button>
            </div>
        </div>
        <div class="form-group mb-3 ">
            <input type="checkbox" name="remember" value="1">
            <label for="remember">Remember me</label>
            <a href="{{ route('register.perform') }}">Sign-up</a>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted">&copy; {{date('Y')}}</p>
    </form>
    <script type="text/javascript">
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $('#captcha-img').html(data.captcha);
                }
            });
        });
    </script>
@endsection
