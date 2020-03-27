<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantComment;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantComment::class, function (Faker $faker) {
    return [
        //
        'comment' => $faker->sentence(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'user_id' => function () {
            return User::all()->random();
        },
        'restaurant_basic_info_id' => function () {
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
