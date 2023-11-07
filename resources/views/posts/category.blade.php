<h2 class="display-6">Category</h2>
<div class="list-group">
    @foreach($categories as $category)
            <a href="{{ route('posts.byCategory', ['category' => $category->id]) }}" class="list-group-item list-group-item-action list-group-item-dark">{{$category->name}}</a>
    @endforeach
</div>
