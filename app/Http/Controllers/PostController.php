<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class PostController extends Controller
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
    /**
     * list blog post
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $posts = Post::find();

        return view('home.index',compact('posts'));
    }   /**
 * list blog post
 *
 *
 * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function store($id)
    {
        $posts = Post::find($id);
        return view('home.index',compact('posts'));
    }
    /**
     * list blog post
     *
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function delete($id)
    {
        $posts = Post::deleted($id);
        return view('home.index',compact('posts'));
    }
}
