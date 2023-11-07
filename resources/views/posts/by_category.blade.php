@extends('layouts.app-master')
@section('title','Blog')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <h1>Posts</h1>
    @if ($posts->count() > 0)
        @foreach($posts->sortByDesc('id') as $post)
            <div class="post">
                <div class="card">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                @if ($post->image_path)
                                    <img src="{{ asset($post->image_path) }}" class="img-thumbnail" alt="Post Image"
                                         style="max-width: 200px;">
                                @else
                                    <img src="{{ asset('path-to-default-image.jpg') }}" class="img-thumbnail"
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
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No results found for this category.</p>
    @endif
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
