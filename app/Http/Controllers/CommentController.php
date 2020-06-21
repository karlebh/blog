<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Like;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('edit', $comment);
        
        
      $comment = Comment::firstOrCreate([
            'user_id' => auth()->user()->id,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => Post::class,
            'body' => $request->body
        ]);
      $comment->commentable()->increment('comments_count');

        return back();  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    { 
        $this->authorize('edit', $comment);
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update([
                    'body' => $request->body,
            ]);

        return redirect()->route('posts.show', $comment->commentable->slug);

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }

}
