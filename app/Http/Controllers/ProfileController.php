<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth')->only('update');
    }


    public function show(User $user)
    {
    	return view('Profile.show', compact('user'));
    }


    public function update(Request $request, User $user)
    {
    	$data = request()->validate([
            'location' => 'string|nullable',
    		'picture' => 'image|nullable',
    		'about' =>  'string|nullable',
    		'DOB' => 'date|nullable',
    	]);

    	if($request->hasFile('picture')){
    		$picturePath = $request->picture->store('profile', 'public');

    		$profileArray = ['picture' => $picturePath];
    	}

        $all = array_merge(
                $data,
                $profileArray ?? []

            );

    	auth()->user()->profile()->update(array_filter($all));

    	return back();

    }

}
