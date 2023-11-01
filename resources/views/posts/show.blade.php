@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>{{ $post->title }}</h1>
        <p> Ngày đăng: {{ $post->created_at }}</p>
        <p> Tác giả: {{ $author->username }}</p>
        <div >
            <img src="{{ asset($post->image_path) }}" alt="Post Image" class="img-thumbnail">
        </div>
        <div class="post-content">
            {!! $post->content !!}
        </div>
    </div>
@endsection
