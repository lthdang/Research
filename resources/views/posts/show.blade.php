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
    @auth
        <div class="mt-4">
            <h5>Comments</h5>
            <div class="bg-light p-3 rounded">
                @forelse($comments as $comment)
                    <div class="comment mb-3">
                        <img src="{{ $user->avatar ? asset($user->avatar) : '#' }}"
                             class=" avatar img-thumbnail" style="width: 30px; height: 30px;">
                        <strong>{{ $comment->name }}: {{ $comment->content }}</strong>

                    </div>
                @empty
                    <p>No comments yet. Be the first one to comment on this post!</p>
                @endforelse
            </div>

            <form method="post" action="{{ route('comments.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label for="content" class="form-label">Your Comment</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>

                @if(auth()->user()->email)
                    <p class="mb-3">Logged in as: <strong>{{ auth()->user()->email }}</strong></p>
                @else
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    @endauth

@endsection
