<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Post;
use App\Comment;

class LikeController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function like(Request $request)
    {
        if(is_null($request->id)){
            return $request->id === 1;
        }
        $like = Like::where('likeable_id',$request->id)
                        ->where('user_id', Auth::id())
                        ->where('like', 1)
                        ->where('likeable_type', Post::class)
                        ->where('dislike', 0)
                        ->first();

        if(is_null($like)){
        // if($like->exists()){
                Like::create([
                'user_id' => Auth::id(),
                'like' => 1,
                'dislike' => 0,
                'likeable_id' => $request->id,
                'likeable_type' => Post::class,
            ]);
        } 
       
    }

    public function unlike(Request $request)
    {
        $like = Like::where('user_id', auth()->user()->id)
                        ->where('like', 1)
                        ->where('dislike', 0)
                        ->where('likeable_id', $request->id)
                        ->where('likeable_type', Post::class)
                        ->orderBy('created_at', 'desc')
                        ->first()
                        ->delete();

    }
    
      public function likeComment(Request $request)
    {
        $check = Like::where('user_id', auth()->user()->id)
                                ->where('likeable_id', $request->id)
                                ->where('likeable_type', Comment::class)
                                ->where('like', 1)
                                ->where('dislike', 0)
                                ->first();
        if($check){
            return;
        }

        Like::create([
                    'user_id' => auth()->user()->id,
                    'like' => 1,
                    'dislike' => 0,
                    'likeable_id' => $request->id,
                    'likeable_type' => Comment::class
                ]);
    } 

    public function unlikeComment(Request $request)
    {
        $like = Like::where('user_id', auth()->user()->id)
                        ->where('likeable_id', $request->id)
                        ->where('likeable_type', Comment::class)
                        ->where('like', 1)
                        ->where('dislike', 0)
                        ->first();

        if(!$like){
            return;
        }

        $like->delete();
    }

    public function check(Request $request){

         $check = (bool) Like::where('user_id', auth()->user()->id)
                        ->where('likeable_id', $request->id)
                        ->where('likeable_type', Comment::class)
                        ->where('like', 1)
                        ->where('dislike', 0)
                        ->first();

        $count = Like::where('likeable_id', $request->id)
                        ->where('likeable_type', Comment::class)
                        ->where('like', 1)
                        ->where('dislike', 0)
                        ->count();

        return response()->json([$check, $count]);


    }

  
}
