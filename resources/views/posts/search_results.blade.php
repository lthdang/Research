@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Search Results for <b>"{{ $keyword }}"</b> </h1>

        @if ($posts->count() > 0)
            @foreach($posts as $post)
                <div class="post">
                    <div class="card">
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <div class="form-group">
                            <img src="{{ asset($post->image_path) }}" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                        <p>{{ $post->describe_short }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No results found for "{{ $keyword }}"</p>
        @endif
    </div>
@endsection
