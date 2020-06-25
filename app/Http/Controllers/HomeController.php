<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function nots()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return view('notify')->with('nots', auth()->user()->notifications);
    }

    public function search(Request $request)
    {
        if(strlen($request->q) < 3){
            return back()->with('q', $request->q);
        }

        $results = \App\Post::search($request->q)->paginate(10);
        return view('search', compact('results'));
    }

    public function feed()
    {
        $friendss = auth()->user()->allFriends();

        $followedPosts = auth()->user()->content()->get();

        return view('home.hello', compact('friendss', 'followedPosts'));
    }

    public function users()
    {
        return view('users')->with(
            'users', \App\User::select('id', 'username', 'gender', 'slug', 'created_at')
                ->where('id', '!=', auth()->user()->id)
                ->latest()
                ->paginate(20));
    }
}
