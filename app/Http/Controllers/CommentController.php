<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Like;
use Illuminate\Http\Request;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        return abort(404);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->validate([
            'img' => 'image|nullable|max:10240',
            'body' => 'required|string'
        ]);
        
        if($request->hasFile('img')){
            $img = $request->img->store('images', 'public');
            $imgArray = ['img' => $img];
        }

        $others = [
            'user_id' => auth()->user()->id,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => Post::class,
            'body' => $request->body
        ];

        $all = array_merge(
            $data, $imageArray ?? [], $others
        );
        
        $comment = Comment::firstOrCreate($all);
        $comment->commentable()->increment('comments_count');

        $comment
            ->commentable
            ->user
            ->notify(
                new CommentNotification($comment->commentable /*the post*/, $comment->user)
            );

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
        $this->authorize('update', $comment);
        $comment->delete();
        return back();
    }

}
