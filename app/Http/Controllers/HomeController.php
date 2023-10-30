<?php

namespace App\Http\Controllers;
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
        $posts = Post::where('status', 'published')->get();
        return view('home.index',compact('posts'));
    }

}
