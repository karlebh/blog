<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'img' => 0,
        'commentable_id' => factory('App\Post'),
        'commentable_type' => 'App\Post',
        'body' => $faker->text,
    ];
});
