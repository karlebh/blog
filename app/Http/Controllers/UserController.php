<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
    	return UserResource::collection(User::paginate(40));
    }

    public function show(User $user)
    {
    	return new UserResource($user);
    }

    public function update(User $user, Request $request)
    {
    	$user->update([
    		'name' => $request->name,
    		'username' => $request->username,
    		'email' => $request->email,
    		]);
    	return response()->json($user);
    }

    public function destroy(User $user)
    {
    	$user->delete();

    	return response()->json('User deleted');
    }

    public function searchUser(Request $request)
    {
        if(strlen($request->q) < 3){
            return back()->with('q', $request->q);
        }
        $query = $request->q;

        $results = User::search($query)->paginate();
        return view('user.search', compact('results'));
    }

}
