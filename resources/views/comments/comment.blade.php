
<div class="comment mb-3">
    @if ($comment->avatar)
        <img src="{{ asset($comment->avatar) }}" class="img-thumbnail" style="width: 30px; height: 30px;" alt="User Avatar">
    @else
        <img src="{{ asset('images/default_image.jpg') }}" class="img-thumbnail" style="width: 30px; height: 30px;" alt="Default Avatar">
    @endif
    <strong>{{ $comment->name }}: {{ $comment->content }}</strong>
    <button class="btn btn-link btn-sm" onclick="showReplyForm({{ $comment->id }})">Reply</button>
    <div id="replyForm{{ $comment->id }}" style="display: none;">
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <div class="mb-3">
                <label for="content" class="form-label">Your Reply</label>
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

            <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
        </form>
    </div>

    @if(isset($isChild) && $isChild)
        <div class="ml-3">
            @include('comments.comment', ['comments' => $comment->replies, 'isChild' => true])
        </div>
    @else
        @include('comments.comment', ['comments' => $comment->replies, 'isChild' => true])
    @endif
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
