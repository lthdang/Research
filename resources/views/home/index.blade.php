@extends('layouts.app-master')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 5000);
    });
</script>

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Dashboard</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary" role="button">New Post</a>
            @if(session('success'))
                <div id="success-alert" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="post">
                <div class="card">
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="card">
                                <table>
                                    <tr>
                                        <th>
                                            <h2>{{$post->title}}</h2>
                                            <div class="form-group">
                                                <img src="{{ asset($post->image_path) }}" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                            <p>{{$post->describe_short}}</p>
                                        </th>
                                        <th>
                                            <form action="{{ route('posts.edit', ['id' => $post->id]) }}" style="display: inline;">
                                                <button type="submit" class="btn btn-lg btn-primary" role="button">Update</button>
                                            </form>

                                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-lg btn-danger" role="button">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endauth

        @guest
            <h1>Posts</h1>
            @foreach($posts as $post)
                <div class="post">
                    <div class="card">
                        <h2>{{$post->title}}</h2>
                        <p>{{$post->created_at}}</p>
                        <div class="form-group">
                            <img src="{{ asset($post->image_path) }}" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        <p>{{ $post->describe_short }}</p>
                    </div>
                </div>
            @endforeach
        @endguest
    </div>
@endsection
