@extends('layouts.app-master')
@section('title','Change-Password')
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="col-md-6 offset-3 pt-4">
                <h3 class="text-center">Change Password</h3>
                @if(Session::get('error') && Session::get('error') != null)
                    <div style="color:red">{{ Session::get('error') }}</div>
                    @php
                        Session::put('error', null)
                    @endphp
                @endif
                @if(Session::get('success') && Session::get('success') != null)
                    <div style="color:green">{{ Session::get('success') }}</div>
                    @php
                        Session::put('success', null)
                    @endphp
                @endif
                <form class="form" action="{{ route('change.password') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        @if($errors->has('current_password'))
                            <div class="alert alert-danger">{{ $errors->first('current_password') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        @if($errors->has('new_password'))
                            <div class="alert alert-danger">{{ $errors->first('new_password') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        @if($errors->has('new_password_confirmation'))
                            <div class="alert alert-danger">{{ $errors->first('new_password_confirmation') }}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary text-center">Submit</button>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </div>
@endsection
