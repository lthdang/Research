@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Dashboard</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary" role="button">New Post</a>
            <div class="post">
                <div class="card">
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="card">
                                <table>
                                    <tr>
                                        <th>
                                            <h2>{{$post->title}}</h2>
                                            <div style="height:100px; width: 100px">{{$post->image}}</div>
                                            <p>{{$post->describe_short}}</p>
                                        </th>
                                        <th>
                                            <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT') <!-- Sử dụng PUT method cho cập nhật -->
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
                        <div style="height:100px; width: 100px">{{$post->image}}</div>
                        <p>{{ $post->describe_short }}</p>
                    </div>
                </div>
            @endforeach
        @endguest
    </div>
@endsection
