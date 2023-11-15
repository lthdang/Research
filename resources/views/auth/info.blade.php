@extends('layouts.app-update')
@section('title','Blog-Info-Profile')
@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
    <div class="bg-light rounded">
        <article class="carousel slide my-4 ">
            <div class="row">
                <div class="col-6 border bg-light">
                    <p class="text-center text-uppercase fw-bold">User Information</p>
                    <div class="row border bg-light     ">
                        <div class="col-5">
                            <p><b>Full Name:</b> {{ $user->full_name }}</p>
                            <p><b>Email:</b> {{ $user->email }}</p>
                            <p><b>Phone:</b> {{ $user->phone }}</p>
                            <p><b>Birth Day:</b> {{ $user->brith_day }}</p>
                        </div>
                        <div class="col-3">
                            <div class="col-md-12 text-center">
                                @if(auth()->user()->avatar)
                                    <img class="img-thumbnail" src="{{ asset(auth()->user()->avatar) }}"
                                         alt="Image Description" style="max-width: 150px;">
                                @else
                                    <img class="img-thumbnail" src="{{ asset('images/default_image.jpg') }}"
                                         alt="Image Description" style="max-width: 150px;">
                                @endif
                                @if($errors->has('avatar'))
                                    <div class="alert alert-danger">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <p><b>Address:</b> {{ $user->address }}</p>
                        </div>
                        <div class="col-5">
                            <form action="{{ route('profile.edit') }}"
                                  style="display: inline;">
                                <button type="submit" class="btn btn-outline-primary">
                                    Update Profile <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-6 border bg-light">
                    <div class="row">
                        <div class="col-12 ">
                            <p class="text-center text-uppercase fw-bold">Account Information</p>
                            <div class="row border bg-light">
                                <div class="col-3">
                                    <div class="col-md-12">
                                        <p><b>User Name</b></p>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="col-md-12">
                                        <input type="text" readonly class="form-control"
                                               placeholder="{{ $user->username}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="col-md-12">
                                        <p><b>Password</b></p>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="col-md-12">
                                        <input type="text" readonly class="form-control" placeholder="****************">
                                        <br>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <form action="{{ route('profile.changePassword') }}"
                                          style="display: inline;">
                                        <button type="submit" class="btn btn-outline-primary">
                                            Change Password <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
