@extends('layouts.app-master')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h1>{{ $post->title }}</h1>
            <p> Ngày đăng: {{ $post->created_at }}</p>
            <p> Tác giả: {{ $author->username }}</p>
            <div class ="text-center">
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
@endsection
