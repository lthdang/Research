@extends('layouts.app-update')
@section('title','Blog-Edit-Profile')
@section('content')
    <script>
        function displayImage(input) {
            var preview = document.getElementById('avatar-preview');
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <div class="container bg-light rounded">
        <div class="row border bg-light">
            <p class="text-center text-uppercase fw-bold border bg-light"> Update personal information</p>
            <div class="col-6">
                {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])  !!}
                <div class="col-md-12">
                    <p><b>User Name</b></p>
                    {!! Form::text('user_name', $user->username, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <p><b>Full Name</b></p>
                    {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
                    @if($errors->has('full_name'))
                        <div class="alert alert-danger">{{ $errors->first('full_name') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <p><b>Email</b></p>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    @if($errors->has('email'))
                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <p><b>Phone</b></p>
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    @if($errors->has('phone'))
                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="col-md-12">
                    <p><b>Address</b></p>
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    @if($errors->has('address'))
                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <p><b>Avatar</b></p>
                    {!! Form::file('avatar', ['class' => 'form-control', 'onchange' => 'displayImage(this)']) !!}
                    <img id="avatar-preview" src="{{ $user->avatar ? asset($user->avatar) : '#' }}"
                         alt="Avatar Preview"
                         class="img-thumbnail" style="max-width: 100px;">
                    @if($errors->has('avatar'))
                        <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <p><b>Date of Birth</b></p>
                    {!! Form::input('datetime-local', 'brith_day', null, ['class' => 'form-control']) !!}
                    @if($errors->has('brith_day'))
                        <div class="alert alert-danger">{{ $errors->first('brith_day') }}</div>
                    @endif
                </div>
            </div>

            <div class="col-6">
                <div class="col-md-12">
                    <br>
                    <b>Sex</b>
                    <label class="radio-inline">
                        {{ Form::radio('sex', '1',  $user->sex, array('id'=>'male')) }} Male
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('sex', 0, !$user->sex) !!} Female
                    </label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-outline-primary">
                    Update Profile <i class="fas fa-edit"></i>
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
