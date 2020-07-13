<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
   public function __construct()
   {
      return $this->middleware('auth');
   }

  public function edit(Comment $comment)
  {
    return view('comment.reply', compact('comment'));
  }

  public function store(Request $request)
  {
    // $this->authorize('edit', Comment::class);

    $data = $request->validate([
          'body' => 'required|string',
          'img' => 'nullable',
    ]);
      
    if($request->hasFile('img')){
        $imagePath = $request->img->store('images', 'public');
        $imageArray = ['img' => $imagePath];
    }

    $others = [
          'user_id' => auth()->user()->id,
          'commentable_id' => $request->commentable_id,
          'commentable_type' => \App\Post::class,
          'body' => $request->body,
          'parent_id' => $request->parent_id,
      ];

    $all = array_filter(
              array_merge(
                $data, $imageArray ?? [], $others
            )
          );

    $comment = Comment::firstOrCreate($all);

    $comment->commentable()->increment('comments_count');

      return redirect()->route('posts.show', $comment->commentable->slug);
  }

}
