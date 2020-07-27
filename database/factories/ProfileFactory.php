<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'picture' => 'profile/picture.jpg',
        'location' => 'Umuode village',
        'DOB' => '2020-07-29',
    ];
});
