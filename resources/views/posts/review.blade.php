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
            @auth()
                <form action="{{ route('posts.edit', ['id' => $post->id]) }}"
                      style="display: inline;">
                    <button type="submit" class="btn btn-lg btn-primary fa fa-pencil-square" role="button">
                        Update
                    </button>
                </form>
                <form action="{{ route('posts.delete', ['id' => $post->id]) }}"
                      method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-danger fa fa-trash" role="button">
                        Delete
                    </button>
                </form>
            @endauth
        </div>
    </div>
@endsection
