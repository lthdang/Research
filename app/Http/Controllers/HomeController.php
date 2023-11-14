<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

class HomeController extends Controller
{
    /**
     * find all post and categories for admin page
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $categories = Category::all();
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $posts = Post::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(5);
        } else {
            $posts = Post::where('status', 'published')->orderBy('id', 'desc')->paginate(5);
        }
        return view('home.index', compact('posts', 'categories'));
    }

    /**
     * find all post and categories for homepage
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function post()
    {
        $categories = Category::all();
        $posts = Post::where('status', 'published')->orderBy('id', 'desc')->paginate(5);
        return view('home.post', compact('posts', 'categories'));
    }
}
