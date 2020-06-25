<?php

namespace App\Traits;

use App\Friend;
use App\User;
trait Friendable
{

	public function addFriend($requestee)
	{
		if(!$this->friendIsAdded($requestee)){
			
			if($friend = $this->storeFriend($requestee))
			{
				return response()->json($friend, 200);
			}	
		
		}
		return response()->json('Not Okay');
	}

	public function deleteFriend()
	{
		
	}

	public function acceptFriend($requester)
	{
		$friend = Friend::where('requester', $requester)
							->where('requestee', $this->id)
							->where('status', 0)
							->first();
		if($friend){
			$this->updateFriend($friend, $requester);
			return response()->json($friend, 200);
		}
		
		return response()->json('Not Okay');
		
	}

	public function declineFriend($requester)
	{
		$friend = Friend::where('requester', $requester)
							->where('requestee', $this->id)
							->where('status', 0)
							->first();
		if(is_null($friend)):
			return 0;
		endif;

		$friend->delete();

		return 1;
	}

	public function unfriend($requester)
	{
		$friend = Friend::where('requester', $requester)
							->where('requestee', $this->id)
							->where('status', 1)
							->first();
		if($friend){
			$friend->update([
					'status' => 0,
			]);

			return response()->json($friend, 200);
		}
		
		return response()->json('Not Okay');
		
	}

	public function allFriends()
	{
		$friends = [];

		$firstSet = Friend::where('requester', $this->id)
							->where('status', 1)
							->get();

		foreach($firstSet as $friend):
			array_push($friends, User::findOrFail($friend->requestee));
		endforeach;

		$secondSet = Friend::where('requestee', $this->id)
							->where('status', 1)
							->get();

		foreach($secondSet as $friend):
			// array_push($friends, 
			// 	User::with('posts', 'categories')->findOrFail($friend->requester));
			array_push($friends, collect(User::select('name','slug')->where('id', $friend->requester)->get()));
		endforeach;

		return $friends;
	}

	public function pendingRequests()
	{
		$all = [];

		$pendingRequests = Friend::where('requestee', $this->id)
									->where('status', 0)
									->get();

		foreach($pendingRequests as $pending):
			array_push($all, User::findOrFail($pending->requester));
		endforeach;

		return $all;
	}

	public function pendingRequestsIds()
	{
		return collect($this->pendingRequests())->pluck('id')->toArray();
	}

	public function pendingRequestsSent()
	{
		$all = [];

		$pendingRequests = Friend::where('status', 0)
									->where('requester', $this->id)
									->get();

		foreach($pendingRequests as $pending):
			//something wierd is happening here
			//refer to $this->pendingRequests()
			array_push($all, User::findOrFail($pending->requestee)); 
		endforeach;

		return $all;
	}

	public function pendingRequestsSentIds()
	{
		return collect($this->pendingRequestsSent())->pluck('id')->toArray();
	}

	public function hasPendingFrom($id)
	{
		if(in_array($id, $this->pendingRequestsIds())):
			return 1;
		endif;
		return 0;
	}


	public function friendsId()
	{
		return collect($this->allFriends())->pluck('id')->toArray();
	}
	

	public function isFriendsWith($id)
	{
		if(in_array($id, $this->friendsId())):
			return 1;
		endif;
		return 0;
	
	}

	public function hasPendingSentTo($id)
	{
		if(in_array($id, $this->pendingRequestsSentIds())):
			return 1;
		endif;
		return 0;
	}


//-----------------------------------------------------------------------
	public function friendIsAdded($requestee)
	{

		return Friend::where('requestee', $requestee)
					->where('requester', $this->id)
					->where('status', 0)
					->first();
	}

	public function storeFriend($requestee)
	{
		if($requestee === $this->id):
			return;
		endif;
		
		return Friend::create([
			'requester' => $this->id,
			'requestee' => $requestee,
			'status' => 0,
		]);
	}

	public function updateFriend($friend, $requester)
	{
		if($requester === $this->id):
			return;
		endif;
		return $friend->update([
			'requester' => $requester,
			'requestee' => $this->id,
			'status' => 1,
			]);
	}
}
