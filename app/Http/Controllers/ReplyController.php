<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
   
    public function edit(Comment $comment)
    {
      return view('comment.reply', compact('comment'));
    }

    public function store(Request $request)
    {
      // $this->authorize('edit', Comment::class);
        
      $comment = Comment::firstOrCreate([
            'user_id' => auth()->user()->id,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => \App\Post::class,
            'body' => $request->body,
            'parent_id' => $request->parent_id,
        ]);
      $comment->commentable()->increment('comments_count');

        return redirect()->route('posts.show', $comment->commentable->slug);
    }

}
