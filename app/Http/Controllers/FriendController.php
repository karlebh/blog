<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Friendable;
use App\User;
use App\Notifications\FriendNotification;
use App\Notifications\AcceptFriend;


class FriendController extends Controller
{
    use Friendable;

  	public function __construct()
  	{
  		return $this->middleware('auth');
  	}

    public function add($id)
    {
        $resp = auth()->user()->addFriend($id);

        event(new \App\Events\Friend());
        User::findOrFail($id)->notify(new FriendNotification(auth()->user()));

    	return $resp;
    }

    public function accept($id)
    {
        $resp = auth()->user()->acceptFriend($id);
        User::findOrFail($id)->notify(new AcceptFriend(auth()->user()));

        return $resp;
    }

    public function decline($id)
    {
        return auth()->user()->declineFriend($id);
    }

    public function check($id)
    {
       if(auth()->user()->isFriendsWith($id)){
            return ['status' => 'friends'];
       }
       if(auth()->user()->hasPendingFrom($id)){
            return ['status' => 'pending'];
       }
        if(auth()->user()->hasPendingSentTo($id)){
        return ['status' => 'waiting'];
       }

       return ['status' => 0];
       
    }

   

}
