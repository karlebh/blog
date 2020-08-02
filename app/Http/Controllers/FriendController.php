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

        // event(new \App\Events\Friend());
        User::findOrFail($id)->notify(new FriendNotification(auth()->user()));

    	// return $resp;
        return ['status' => 'waiting'];
    }

    public function accept($id)
    {
        $resp = auth()->user()->acceptFriend($id);
        User::findOrFail($id)->notify(new AcceptFriend(auth()->user()));

        // return $resp;
        return ['status' => 'friends']
    }

    public function decline($id)
    {
        auth()->user()->declineFriend($id);

        return ['status' => 0];
    }

    public function check($id)
    {
       // if(auth()->user()->isFriendsWith($id) === 1){
       //      return ['status' => 'friends'];
       // }
       // else if(auth()->user()->hasPendingFrom($id) === 1){
       //      return ['status' => 'pending'];
       // }
       //  else if(auth()->user()->hasPendingSentTo($id) === 1){
       //  return ['status' => 'waiting'];
       // }
       // else {
       // return ['status' => 0];
        
       // }

       if(auth()->user()->hasPendingFrom($id) === 1){
            return ['status' => 'pending'];
       }
       
    }

   

}
