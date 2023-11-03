@extends('layouts.app-master')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Dashboard</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary" role="button">New Post</a>
            <div class="post">
                <div class="card">
                    @foreach($posts->sortByDesc('id') as $post)
                        <div class="post">
                            <div class="card">
                                <table>
                                    <tr>
                                        <th>
                                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                                <h4>{{$post->title}}</h4></a>
                                            <div class="form-group">
                                                <img class="card-img-top" src="{{ asset($post->image_path) }}"
                                                     class="img-thumbnail"
                                                     style="max-width: 200px;">
                                            </div>
                                            <div class="post-content">
                                                {!! $post->describe_short !!}
                                            </div>
                                        </th>
                                        <th>
                                            <form action="{{ route('posts.edit', ['id' => $post->id]) }}"
                                                  style="display: inline;">
                                                <button type="submit" class="btn btn-lg btn-primary" role="button">
                                                    Update
                                                </button>
                                            </form>

                                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}"
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-lg btn-danger" role="button">
                                                    Delete
                                                </button>
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
            @foreach($posts->sortByDesc('created_at') as $post)
                <div class="post">
                    <div class="card">
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                            <h5>{{$post->title}}</h5></a>
                        <div class="form-group">
                            <img src="{{ asset($post->image_path) }}" class="img-thumbnail"
                                 style="max-width: 200px;">
                        </div>
                        <p>{{ $post->describe_short }}</p>
                    </div>
                </div>
            @endforeach
        @endguest
    </div>
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
