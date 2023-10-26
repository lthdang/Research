<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * list blog post
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $posts = Post::all();
        return view('home.index',compact('posts'));
    }

}
