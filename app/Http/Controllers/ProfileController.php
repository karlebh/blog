<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    // 	return $this->middleware('auth');
    // }

    public function show(User $user)
    {
    	return view('Profile.show', compact('user'));
    }
}
