<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
    	
    	return view('Sub.index');
    }

    public function store(Request $request)
    {
    	auth()->user()->newSubscription('default','blog')
    						->create($request->payment_method, ['email' => auth()->user()->email]);
    }
}
