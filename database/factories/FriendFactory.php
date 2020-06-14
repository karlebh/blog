<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Friend;
use Faker\Generator as Faker;

$factory->define(Friend::class, function (Faker $faker) {
    return [
        'requester' => factory('App\User'),
        'requestee' => factory('App\User'),
        'status' => random_int(0, 1),
    ];
});
