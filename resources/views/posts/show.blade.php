@extends('layouts.app-master')
@section('title','Blog-Detail')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h1>{{ $post->title }}</h1>
            <p> Ngày đăng: {{ $post->created_at }}</p>
            <p> Tác giả: {{ $author->username }}</p>
            <div class="text-center">
                <img src="{{ asset($post->image_path) }}" alt="Post Image" class="rounded">
            </div>
            <div class="post-content">
                {!! $post->content !!}
            </div>
            @auth()
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
            @endauth
        </div>
    </div>
    @guest()
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



    @endguest

@endsection
