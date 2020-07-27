<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Illuminate\Support\Str;	
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$desc = $faker->paragraph;
    return [
    	'user_id' => factory('App\User'),
        'name' => $faker->name,
        'slug' => Str::limit(Str::slug($desc), 10, ''),
        'desc' => $desc,
        'color' => '#' . random_int(000000, 999999),
        'posts_count' => random_int(300, 500),
        'views_count' => random_int(100, 500),
    ];
});
