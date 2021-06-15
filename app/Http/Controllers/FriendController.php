<?php

namespace App\Http\Controllers;

use App\User;
use App\Friend;
use Illuminate\Http\Request;
use App\Notifications\AcceptFriend;
use App\Notifications\FriendNotification;


class FriendController extends Controller
{
  	public function __construct() 
    {
  		return $this->middleware('auth');
  	}

    public function add($id)
    {
      
      Friend::firstOrCreate([
        'requester' => auth()->user()->id,
        'requestee' => $id,
        'status' => 'waiting'
      ]);

      User::findOrFail($id)->notify(new FriendNotification(auth()->user()));

      return ['status' => 'waiting'];
    }

    public function accept($id)
    {
        Friend::where([
            'requester' => $id,
            'requestee' => auth()->user()->id,
        ])->update(['status' => 'friends']);

        User::findOrFail($id)->notify(new AcceptFriend(auth()->user()));

        return ['status' => 'friends'];
    }

    public function decline($id)
    {
         $request = Friend::where([
            'requester' => $id,
            'requestee' => auth()->user()->id,
            'status' => 'notFriends'
        ]);

        $request->delete();

        return ['status' => 'notFriends'];
    }

    public function check($id)
    {
      $status = [];

        if ($this->isFriendsWith($id)) {
           return $status['status'] = 'friends';
        } 

         if ($this->isWaitingFor($id)) {
          return $status['status'] = 'waiting';
        } 

         if ($this->hasPendingFrom($id)) {
          return $status['status'] = 'pending';
        }

         return $status['status'] = 'notFriends';


    }

    public function isFriendsWith($id) {
      return Friend::where([
            'requester' => $id,
            'requestee' => auth()->user()->id,
            'status' => 'friends',
        ])->orWhere([
            'requester' => auth()->user()->id,
            'requestee' => $id,
            'status' => 'friends',
        ])->exists();
    }

    // public function isNotFriendsWith($id) {
    //   return Friend::where([
    //         'requester' => $id,
    //         'requestee' => auth()->user()->id,
    //         'status' => 'notFriends',
    //     ])->orWhere([
    //         'requester' => auth()->user()->id,
    //         'requestee' => $id,
    //         'status' => 'notFriends',
    //     ])->exists();
    // }

    public function isWaitingFor($id) {
      return Friend::where([
                'requester' => auth()->user()->id,
                'requestee' => $id,
                'status' => 'waiting',
            ])->exists();
    }

     public function hasPendingFrom($id) {
      return Friend::where([
                'requester' => $id,
                'requestee' =>  auth()->user()->id,
                'status' => 'pending',
            ])->exists();
    }
   
}
