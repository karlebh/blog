<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{

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
}
