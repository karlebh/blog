<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Like;
use App\Post;
use App\Comment;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('users', 'feed', 'nots');
    }
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
        $nots = auth()->user()->notifications;
        
        return view('notify', compact('nots'));
    }

    public function search(Request $request)
    {
        if(strlen($request->q) < 3){
        	session()->flash('error', 'You only search for 3 words and above!');
            return back()->with('q', $request->q);
        }
        //$request->validate(['q' => ['string']);
        $query = $request->q;

        $results = \App\Post::search($query)->get();
        return view('search', compact('results'));
    }
    
    public function users()
    {
        return view('users')->with(
            'users', \App\User::select('id', 'username', 'gender', 'slug', 'created_at')
                ->latest()
                ->simplePaginate(20));
    }
}
