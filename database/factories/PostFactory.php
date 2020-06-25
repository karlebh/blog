<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(Post::class, function (Faker $faker) {

    $text = $faker->paragraph;
    return [
    	'user_id' => factory('App\User')->create()->id,
        'category_id' => factory('App\Category')->create()->id,
        'title' => $faker->sentence,
        'desc'=> $text,
        'slug' => trim(Str::limit(Str::slug($text), 50, ''), '-'),
        'img'=> $faker->image('public/storage/images/', 640, 480, 'cats'),
        'comments_count' => random_int(20, 100),
        'views_count' => random_int(20, 100),
        'best_reply' => 0,
        'locked' => false,
        'pinned' => 0,
    ];
});
