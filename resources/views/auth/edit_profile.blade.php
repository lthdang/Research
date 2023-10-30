@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Edit Profile</h1>

        {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('full_name', 'User Name') !!}
            {!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('full_name', 'Full Name') !!}
            {!! Form::text('full_name', $user->full_name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', 'Address') !!}
            {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sex', 'Sex') !!}
            <label class="radio-inline">
                {!! Form::radio('sex', 1, $user->sex) !!} Male
            </label>
            <label class="radio-inline">
                {!! Form::radio('sex', 0, !$user->sex) !!} Female
            </label>
        </div>

        <div class="form-group">
            {!! Form::label('brith_day', 'Date of Birth') !!}
            {!! Form::input('datetime-local', 'brith_day', $user->brith_day, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('avatar', 'Avatar') !!}
            @if ($user->avatar)
                <img src="{{ asset($user->avatar) }}" alt="Current Avatar" class="img-thumbnail" style="max-width: 100px;">
            @endif
            {!! Form::file('avatar', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
