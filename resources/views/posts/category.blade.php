<h1 class="my-4">Category</h1>
<div class="list-group">
    @foreach($categories as $category)
        <a href="{{ route('posts.byCategory', ['category' => $category->id]) }}" class="list-group-item">{{$category->name}}</a>
    @endforeach
</div>
