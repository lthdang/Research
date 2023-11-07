@extends('layouts.app-master')
@section('title','Blog-Search')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Search Results for <b>"{{ $keyword }}"</b></h1>

        @forelse($posts as $post)
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
        @empty
            <p>No results found for "{{ $keyword }}"</p>
        @endforelse
    </div>
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection

