<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Comment;
use App\Post;
use App\Friend;


class FeedController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function followedPosts()
    {
        $followedPosts = auth()->user()->content()->paginate(15);

        return view('feed.followedPosts', compact('followedPosts'));
    }

    public function likedPosts()
    {
    	$likedPostId = Like::where('user_id', auth()->user()->id)
    			->where('likeable_type', 'App\Post')
    			->pluck('likeable_id');

        $likedPosts = Post::whereIn('id', $likedPostId)->paginate(15);
        return view('feed.likedPosts', compact('likedPosts'));
    }

    public function likedComments()
    {
        $likedCommentId = Like::where('user_id', auth()->user()->id)
                ->where('likeable_type', 'App\Comment')
                ->pluck('likeable_id');

        $likedComments = Comment::whereIn('id', $likedCommentId)->paginate(15);
        return view('feed.likedComments')->withLikedComments($likedComments);
    }

}
