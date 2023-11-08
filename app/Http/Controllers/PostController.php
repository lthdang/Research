<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     *
     * search blog post
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function search(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->input('keyword');

        if (auth()->check() && auth()->user()) {
            $user = auth()->user();
            $posts = Post::where(function ($query) use ($keyword, $user) {
                $query->where('user_id', $user->id)
                    ->where(function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('content', 'LIKE', '%' . $keyword . '%');
                    });
            })->paginate(5);
        } else {
            $posts = Post::where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('content', 'LIKE', '%' . $keyword . '%');
            })->paginate(5);
        }

        return view('posts.search_results', compact('posts', 'keyword', 'categories'));
    }


    public function show($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $post->id)->get();
        $author = User::find($post->user_id);
        return view('posts.show', compact('post', 'author', 'categories', 'comments'));
    }

    /**
     *
     *
     *
     *
     */
    public function getPostsByCategory($category)
    {
        $categories = Category::all();


        if (auth()->check() && auth()->user()) {
            $user = auth()->user();
            $posts = Post::where('category_id', $category)->where('user_id', $user->id)->orderBy('id', 'desc')->paginate(4);
        } else {
            $posts = Post::where('category_id', $category)->orderBy('id', 'desc')->paginate(4);
        }

        return view('home.index', compact('posts', 'category', 'categories'));
    }

    /**
     * list blog posts
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $post = new Post;
        return view('posts.create', compact('post', 'categories'));
    }

    /**
     * list blog posts
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['image_path'] = 'images/' . $imageName;
        }
        $input['user_id'] = auth()->user()->id;
        try {
            Post::create($input);
        } catch (\ErrorException $exception) {
            dd($exception);
        }
        return redirect()->route('home.index')->with('success', 'Thông tin bài viết của bạn đã được khởi tạo thành công.');
    }

    /**
     * list blog posts
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->image_path) {
                $oldImagePath = public_path($post->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $post->delete();
        }
        return redirect()->route('home.index')->with('success', 'Bài viết của bạn đã được xoá.');
    }


    /**
     * list blog posts
     *
     *
     * @return  \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all()->pluck('name', 'id');
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->describe_short = $request->input('describe_short');
        $post->category_id = $request->input('category_id');
        $post->status = $request->input('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            if ($post->image_path) {
                $oldImagePath = public_path($post->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $post->image_path = 'images/' . $imageName;
        }
        $post->save();
        return redirect()->route('home.index')->with('success', 'Thông tin bài viết của bạn đã được cập nhật.');
    }

}
