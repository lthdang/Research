@extends('layouts.app-master')
@section('title','Blog-Detail')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="container">
        <div class="bg-light p-5 rounded">
            <form action="{{ route('home.index', ['id' => $post->id]) }}"
                  style="display: inline;">
                <button type="submit" class="btn btn-outline-primary">
                    Back  <i class="fas fa-backward"></i>
                </button>
            </form>


            <h1 class="h1-title text-center">{{ $post->title }}</h1>
            <p><b>Ngày đăng:</b> {{ $post->created_at }}</p>
            <p> <b>Tác giả:</b> {{ $author->username }}</p>
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
                    <button type="submit" class="btn btn-outline-primary">
                        Edit <i class="fas fa-edit"></i>
                    </button>
                </form>
                <form action="{{ route('posts.delete', ['id' => $post->id]) }}"
                      method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" role="button">
                        Delete <i class="fa fa-trash"></i>
                    </button>
                </form>
            @endauth
        </div>
    </div>
@endsection
