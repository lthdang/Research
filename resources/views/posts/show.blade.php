@extends('layouts.app-master')
@section('title','Blog-Detail')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h1 class="h1-title">{{ $post->title }}</h1>
            <p> Ngày đăng: {{ $post->created_at }}</p>
            <p> Tác giả: {{ $author->username }}</p>
            <div class="text-center">
                @if ($post->image_path)
                    <img src="{{ asset($post->image_path) }}" class="img-thumbnail" alt="Post Image">
                @else
                    <img src="{{ asset('images/default_image.jpg') }}" class="img-thumbnail " alt="Default Image">
                @endif
            </div>
            <div class="post-content">
                {!! $post->content !!}
            </div>
        </div>
    </div>
    @auth()
        <h5> Comment</h5>
        <div class="bg-light p-1 rounded">
            @forelse($comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->name }}</strong>
                    <p>{{ $comment->content }}</p>
                </div>
            @empty
                <p>Chưa có bình luận nào hết, hãy là người đầu tiên bình luận bài viết này!!!</p>
            @endforelse
        </div>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Comment</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>

    @endauth

@endsection
