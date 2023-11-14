@extends('layouts.app-master')
@section('title','Blog')
@section('category')
    @include('posts.category_admin')
@endsection
@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-light p-2 rounded">
        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-outline-primary fa fa-plus-circle" role="button">
                New Post</a>
            <div class="post">
                <div class="card">
                    @foreach($posts->sortByDesc('id') as $post)
                        <div class="post">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('posts.review', ['id' => $post->id]) }}" class="post-title">
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
                                        <h4><a href="{{ route('posts.review', ['id' => $post->id]) }}"
                                               class="post-title">{{$post->title}}</a></h4>
                                        <div class="post-content">
                                            {!! $post->describe_short !!}
                                        </div>
                                        <div class="button-group">
                                            <form action="{{ route('posts.edit', ['id' => $post->id]) }}"
                                                  style="display: inline;">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Edit <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}"
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" role="button">
                                                    Delete <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pagination">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @endauth
    </div>

@endsection
