@extends('layouts.app-master')
@section('title','Blog')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-light p-2 rounded">
        @auth
            <h1 class=" h1-title">Dashboard</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary fa fa-plus-circle" role="button"> New Post</a>
            <div class="post">
                <div class="card">
                    @foreach($posts->sortByDesc('id') as $post)
                        <div class="post">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                            @if ($post->image_path)
                                                <img src="{{ asset($post->image_path) }}"
                                                     class="img-thumbnail img-fixed-size" alt="Post Image"
                                                     style="max-width: 200px;">
                                            @else
                                                <img src="{{ asset('images/default_image.jpg') }}" class="img-thumbnail"
                                                     alt="Default Image" style="max-width: 200px;">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <h4><a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                               class="post-title">{{$post->title}}</a></h4>
                                        <div class="post-content">
                                            {!! $post->describe_short !!}
                                        </div>
                                        <div class="button-group">
                                            <form action="{{ route('posts.edit', ['id' => $post->id]) }}"
                                                  style="display: inline;">

                                                <button type="submit" class="btn btn-primary fa fa-pencil-square" role="button">Update
                                                </button>
                                            </form>
                                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}"
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger fa fa-trash" role="button">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                    @if ($post->image_path)
                                        <img src="{{ asset($post->image_path) }}" class="img-thumbnail img-fixed-size"
                                             alt="Post Image">
                                    @else
                                        <img src="{{ asset('images/default_image.jpg') }}"
                                             class="img-thumbnail img-fixed-size" alt="Default Image"
                                             style="max-width: 200px;">
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h4><a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                       class="post-title">{{$post->title}}</a></h4>
                                <div class="post-content">
                                    {!! $post->describe_short !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endguest
    </div>
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
