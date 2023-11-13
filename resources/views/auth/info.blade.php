@extends('layouts.app-update')
@section('title','Blog-Info-Profile')
@section('content')
    <div class="bg-light rounded">
        <article class="carousel slide my-4 ">
            <div class="row">
                <div class="col-6">
                    <p class="text-center"> Thông tin người dùng</p>
                    <div class="row">
                        <div class="col-5">
                            <p> Full Name: {{ $user->full_name }}</p>
                            <p> Email: {{ $user->email }}</p>
                            <p> Phone: {{ $user->phone }}</p>
                            <p> Birth Day: {{ $user->brith_day }}</p>

                        </div>
                        <div class="col-3">
                            <div class="col-md-12 text-center">
                                <img id="avatar-preview" src="{{ $user->avatar ? asset($user->avatar) : '#' }}"
                                     alt="Avatar Preview"
                                     class="img-thumbnail" style="max-width: 150px;">
                                @if($errors->has('avatar'))
                                    <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <p> Address: {{ $user->address }}</p>
                        </div>
                    </div>

                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-5">

                            <p> User Name: {{ $user->username }}</p>
                            <p> Email: {{ $user->email }}</p>
                            <p> Phone: {{ $user->phone }}</p>
                            <p> Birth Day: {{ $user->brith_day }}</p>

                        </div>
                        <div class="col-3">
                            <div class="col-md-12 text-center">
                                <img id="avatar-preview" src="{{ $user->avatar ? asset($user->avatar) : '#' }}"
                                     alt="Avatar Preview"
                                     class="img-thumbnail" style="max-width: 250px;">
                                @if($errors->has('avatar'))
                                    <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <p> Address: {{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
