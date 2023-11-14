<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * store information of the comments
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User authentication failed.');
            }
            $request->validate([
                'post_id' => 'required|exists:posts,id',
                'content' => 'required',
            ]);
            $post_id = $request->input('post_id');
            $content = $request->input('content');
            $post = Post::find($post_id);
            if (!$post) {
                return redirect()->back()->with('error', 'Post not found.');
            }
            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->content = $content;
            $comment->name = $user->username;
            $comment->email = $user->email;
            $comment->avatar = $user->avatar;

            if ($request->has('parent_id')) {
                $parentComment = Comment::find($request->input('parent_id'));
                $comment->parent()->associate($parentComment);
            }
            $comment->save();
            return redirect()->back()->with('success', 'Comment added successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error occurred.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }

    }
}
