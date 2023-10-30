<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * list blog posts
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $posts = Post::where('user_id', $user_id)->get();
        return view('home.index',compact('posts'));
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
    }  /**
 * list blog posts
 *
 *
 * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $describeShort = $request->input('describe_short');
        $category_id = $request->input('category_id');
        $status =$request->input('status');
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->describe_short = $describeShort;
        $post->category_id = $category_id;
        $post->user_id = auth()->user()->id;
        $post->status = $status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image_path ='images/' . $imageName;
        }
        $post->save();
        return redirect()->route('home.index');
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
            $post->delete();
        }
        $posts = Post::all();
        return redirect()->route('home.index');
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
                $oldImagePath = public_path( $post->image_path);
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
