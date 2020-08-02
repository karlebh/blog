<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('users', 'UserController@index')->name('user.index');
Route::get('users/show/{user}', 'UserController@show')->name('user.show');
Route::post('users/update/{user}', 'UserController@update')->name('user.update');
Route::post('users/delete/{user}', 'UserController@destroy')->name('user.delete');