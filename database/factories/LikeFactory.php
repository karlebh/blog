<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {

    return [
        'user_id' => factory('App\User')->create()->id,
        'like' => 1,
        'dislike' => 0,
        'likeable_id' => factory('App\Post')->create()->id,
        'likeable_type' => \App\Post::class,
    ];
});
