<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

class HomeController extends Controller
{
    /**
     * list blog posts
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $categories = Category::all();
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $posts = Post::where('user_id', $user_id) -> orderBy('id', 'desc') -> paginate(4);
        } else {
            $posts = Post::where('status', 'published') ->orderBy('id', 'desc') -> paginate(4);
        }
        return view('home.index', compact('posts','categories'));
    }

}
