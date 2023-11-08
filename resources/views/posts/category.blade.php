<h2 class="font-cursive">Category</h2>
<div class="list-group">
    @foreach($categories as $category)
            <a href="{{ route('posts.byCategory', ['category' => $category->id]) }}"
               class="list-group-item list-group-item-action   ">{{$category->name}}</a>
    @endforeach
</div>
