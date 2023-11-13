@extends('layouts.app-master')
@section('title','Blog')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-light p-2 rounded">
        @foreach($posts->sortByDesc('created_at') as $post)
            <div class="post">
                <div class="card">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                @if ($post->image_path)
                                    <img src="{{ asset($post->image_path) }}" class="img-thumbnail img-fixed-size"
                                         alt="Post Image">
                                @else
                                    <img src="{{ asset('images/default_image.jpg') }}"
                                         class="img-thumbnail img-fixed-size" alt="Default Image"
                                         style="max-width: 200px;">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-9">
                            <h4><a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                   class="post-title">{{$post->title}}</a></h4>
                            <div class="post-content">
                                {!! $post->describe_short !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagination">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
