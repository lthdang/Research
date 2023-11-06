@extends('layouts.app-master')
@section('title','Blog')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <h1>Posts</h1>
    @if ($posts->count() > 0)
        @foreach($posts as $post)
            <div class="post">
                <div class="card">
                    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                        <h4>{{ $post->title }}</h4>
                    </a>
                    <div class="form-group">
                        <img src="{{ asset($post->image_path) }}" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                    <p>{{ $post->describe_short }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>No results found for this category.</p>
    @endif
@endsection
