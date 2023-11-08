@extends('layouts.app-master')
@section('title','Blog-Search')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="bg-light p-5 rounded">
        <h1 class ="h1-title">Search Results for <b>"{{ $keyword }}"</b></h1>

        @forelse($posts->sortByDesc('id') as $post)
            <div class="post">
                <div class="card">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">
                                @if ($post->image_path)
                                    <img src="{{ asset($post->image_path) }}" class="img-thumbnail img-fixed-size" alt="Post Image" style="max-width: 200px;">
                                @else
                                    <img src="{{ asset('images/default_image.jpg') }}" class="img-thumbnail img-fixed-size" alt="Default Image" style="max-width: 200px;">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-9">
                            <h4><a href="{{ route('posts.show', ['id' => $post->id]) }}" class="post-title">{{$post->title}}</a></h4>
                            <div class="post-content">
                                {!! $post->describe_short !!}
                            </div>
                        </div>
                    </div>
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

