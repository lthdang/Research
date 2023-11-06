<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $post_id = $request->input('post_id');
        $content = $request->input('content');
        $name = $request->input('name');
        $email = $request->input('email');

        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->content = $content;
        $comment->name = $name;
        $comment-> email = $email;

        $comment->save();

        return redirect()->back();
    }

}
