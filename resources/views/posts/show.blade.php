@extends('layouts.app-master')
@section('title','Blog-Detail')
@section('category')
    @include('posts.category')
@endsection
@section('content')
    <div class="container">
        <div class="bg-light p-5 rounded">
            <form action="{{ route('home.post', ['id' => $post->id]) }}"
                  style="display: inline;">
                <button type="submit" class="btn btn-outline-primary">
                    Back <i class="fas fa-backward"></i>
                </button>
            </form>
            <h1 class="h1-title text-center">{{ $post->title }}</h1>
            <p><b>Ngày đăng:</b> {{ $post->created_at }}</p>
            <p><b>Tác giả:</b> {{ $author->username }}</p>
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
                        @if ($comment->avatar)
                            <img src="{{ asset($comment->avatar) }}" class="img-thumbnail"
                                 style="width: 30px; height: 30px;" alt="User Avatar">
                        @else
                            <img src="{{ asset('images/default_image.jpg') }}" class="img-thumbnail "
                                 style="width: 30px; height: 30px;" alt="Default Avatar">
                        @endif
                        <strong>{{ $comment->name }}: {{ $comment->content }}</strong>
                        <button class="btn btn-link btn-sm" onclick="likeComment({{ $comment->id }})">
                            <i class="fas fa-thumbs-up"></i> {{ $comment->likes }}
                        </button>
                        <button class="btn btn-link btn-sm" onclick="dislikeComment({{ $comment->id }})">
                            <i class="fas fa-thumbs-down"></i> {{ $comment->dislikes }}
                        </button>
                        <button class="btn btn-link btn-sm" onclick="showReplyForm({{ $comment->id }})">Reply
                        </button>
                        <div id="replyForm{{ $comment->id }}" style="display: none;">
                            <form method="post" action="{{ route('comments.store') }}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Your Reply</label>
                                    <textarea name="content" id="content" class="form-control" rows="3"
                                              required></textarea>
                                </div>

                                @if(auth()->check())
                                    <p class="mb-3">Logged in as: <strong>{{ auth()->user()->email }}</strong></p>
                                @else
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Your Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No comments yet. Be the first one to comment on this post!</p>
                @endforelse
            </div>

            <!-- Form chính để thêm bình luận mới -->
            <form method="post" action="{{ route('comments.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label for="content" class="form-label">Your Comment</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>

                @if(auth()->check())
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

        <script>
            function showReplyForm(commentId) {
                var replyForm = document.getElementById('replyForm' + commentId);
                if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                    replyForm.style.display = 'block';
                } else {
                    replyForm.style.display = 'none';
                }
            }
        </script>
    @endauth

@endsection
