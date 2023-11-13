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
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="col-12">
                    {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])  !!}
                    <div class="col-md-12">
                        {!! Form::label('user_name', 'User Name' ) !!}
                        {!! Form::text('user_name', $user->username, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('full_name', 'Full Name') !!}
                        {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
                        @if($errors->has('full_name'))
                            <div class="alert alert-danger">{{ $errors->first('full_name') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        @if($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        @if($errors->has('phone'))
                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        @if($errors->has('address'))
                            <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        {!! Form::label('avatar', 'Avatar') !!}
                        {!! Form::file('avatar', ['class' => 'form-control', 'onchange' => 'displayImage(this)']) !!}
                        <img id="avatar-preview" src="{{ $user->avatar ? asset($user->avatar) : '#' }}"
                             alt="Avatar Preview"
                             class="img-thumbnail" style="max-width: 100px;">
                        @if($errors->has('avatar'))
                            <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        {!! Form::label('sex', 'Sex') !!}
                        <label class="radio-inline">
                            {{ Form::radio('sex', '1',  $user->sex, array('id'=>'male')) }} Male
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('sex', 0, !$user->sex) !!} Female
                        </label>
                    </div>

                    <div class="col-md-12">
                        {!! Form::label('brith_day', 'Date of Birth') !!}
                        {!! Form::input('datetime-local', 'brith_day', null, ['class' => 'form-control']) !!}
                        @if($errors->has('brith_day'))
                            <div class="alert alert-danger">{{ $errors->first('brith_day') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        {!! Form::submit('Update Profile', ['class' => 'btn btn-primary fa fa-pencil-square']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
