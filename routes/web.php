<?php

use Illuminate\Support\Facades\Route;

Route::get('hell', function () {
	// return \App\Friend::where([
 //                'requester' => 5,
 //                'requestee' => auth()->user()->id,
 //                'status' => 'waiting',
 //            ])->get();
 return auth()->user()->id;
    });


Route::get('/', 'PostController@index')->name('home');

Route::resource('posts', 'PostController');

Route::resource('category', 'CategoryController');
Route::resource('comments', 'CommentController');

Route::get('comment/{comment}/reply', 'ReplyController@edit')->name('reply.comment');
Route::post('comment', 'ReplyController@store')->name('reply.store');

Route::post('profile/update', 'ProfileController@update')->name('profile.update');
Route::get('profile/{user:username}', 'ProfileController@show')->name('profile.show');

Route::post('likeComment', 'LikeController@likeComment');
Route::post('unlikeComment', 'LikeController@unlikeComment');
Route::post('checkComment', 'LikeController@check');

Route::resource('subscription', 'SubscriptionController');

Route::get('users', 'HomeController@users')->name('users');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index');
Route::get('nots', 'HomeController@nots')->name('nots');
Route::get('search', 'HomeController@search')->name('search');


Route::post('like', 'LikeController@like')->name('like.create');
Route::post('unlike', 'LikeController@unlike')->name('like.delete');


Route::get('addFriend/{id}', 'FriendController@add')->name('friend.add');
Route::get('acceptFriend/{id}', 'FriendController@accept')->name('friend.accept');
Route::get('declineFriend/{id}', 'FriendController@decline')->name('friend.decline');
Route::get('check/{id}', 'FriendController@check')->name('friend.check');

Route::post('followPost/{post:id}', 'PostSubscription@subscribe');

Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('github.login');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback')
		->name('github.redirect');


Route::group(
	['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'],
	 function(){
		Route::get('home', 'HomeController@index');
});

Route::get('searchUser', 'UserController@searchUser')->name('searchUser');
Route::view('searchResults', 'users.search');

Route::get('likedPosts', 'FeedController@likedPosts')->name('likedPosts');
Route::get('friendsPosts', 'FeedController@friendsPosts')->name('friendsPosts');
Route::get('followedPosts', 'FeedController@followedPosts')->name('followedPosts');

Route::group([
	'namespace' => 'Admin',
	'middleware' => 'admin',
	'prefix' => 'admin',
	], function () {
	Route::view('index', 'HomeController@index')->name('admin.index');
});