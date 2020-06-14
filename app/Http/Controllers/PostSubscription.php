<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostSubscription extends Controller
{
    public function subscribe(Post $post)
    {
    	return auth()->user()->content()->toggle($post->id);
    }
}
