<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Friendable;
use App\Like;
use App\Comment;
use App\Post;
use App\Friend;


class FeedController extends Controller
{
    use Friendable;

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
        $likedPostId = collect(
                Like::select('likeable_id')
                        ->where('user_id', auth()->user()->id)
                        ->where('likeable_type', 'App\Post')
                        ->get()
                    )->pluck('likeable_id')
                    ->toArray();

        $likedPosts = Post::whereIn('id', $likedPostId)->paginate(15);
        return view('feed.likedPosts', compact('likedPosts'));
    }

    // public function likedComments()
    // {
    //     $likedCommentId = collect(
    //             Like::select('likeable_id')
    //                     ->where('user_id', auth()->user()->id)
    //                     ->where('likeable_type', 'App\Comment')
    //                     ->get()
    //                 )->pluck('likeable_id')
    //                 ->toArray();

    //     $likedComments = Comment::whereIn('id', $likedCommentId)->paginate(15);
    //     return view('feed.likedComments')->withLikedComments($likedComments);
    // }

    public function friendsPosts()
    {
        $friendsPosts = Post::whereIn('id', $this->friendsId())->paginate(15);

        return view('feed.friendsPosts', compact('friendsPosts'));

    }

}
