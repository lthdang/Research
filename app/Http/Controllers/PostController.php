<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
     * search blog post with keyword
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function search(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('posts.search_results', compact('posts', 'keyword', 'categories'));
    }

    /**
     * return view with all posts and categories
     *
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        try {
            $user = auth()->user();
            $categories = Category::all();
            $post = Post::findOrFail($id);
            $comments = Comment::where('post_id', $post->id)->get();
            $author = User::find($post->user_id);
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('posts.show', compact('post', 'author', 'user', 'categories', 'comments'));
    }

    /**
     *  review post
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function review($id)
    {
        try {
            $categories = Category::all();
            $post = Post::findOrFail($id);
            $comments = Comment::where('post_id', $post->id)->get();
            $author = auth()->user();
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('posts.review', compact('post', 'author', 'categories', 'comments'));
    }

    /**
     * Classify articles based on category for homepage
     *
     * @param $category
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function getPostsByCategory($category)
    {
        try {
            $categories = Category::all();
            $posts = Post::where('category_id', $category)->orderBy('id', 'desc')->paginate(4);
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('home.post', compact('posts', 'category', 'categories'));
    }

    /**
     * Classify articles based on category for admin page
     *
     * @param $category
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function getPostsByCategoryAdmin($category)
    {
        try {
            $categories = Category::all();
            if (auth()->check() && auth()->user()) {
                $user = auth()->user();
                $posts = Post::where('category_id', $category)->where('user_id', $user->id)->orderBy('id', 'desc')->paginate(4);
            }
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('home.index', compact('posts', 'category', 'categories'));
    }

    /**
     *  create the article with the article's information
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        try {
            $categories = Category::all()->pluck('name', 'id');
            $post = new Post;
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return view('posts.create', compact('post', 'categories'));
    }

    /**
     * Store article information into the database
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        try {
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
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return redirect()->route('home.index')->with('success', 'Thông tin bài viết của bạn đã được khởi tạo thành công.');
    }

    /**
     * delete posts with selected id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
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
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return redirect()->route('home.index')->with('success', 'Bài viết của bạn đã được xoá.');
    }


    /**
     * Find post by id to make post edits
     *
     *
     * @return  \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
            $categories = Category::all()->pluck('name', 'id');
        } catch (\Exception $e) {
            return view('errors.404');
        }

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Edit post information and save
     *
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            return view('errors.404');
        }
        return redirect()->route('home.index')->with('success', 'Thông tin bài viết của bạn đã được cập nhật.');
    }

}
