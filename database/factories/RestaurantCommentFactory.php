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
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5), // 48.8932,
        'name' => $faker->randomElement(['Rinzin', 'Tashi', 'Dorjee', 'Passang', 'Dolma']),
        'avatar' => $faker->randomElement(['/img/avatar1.png', '/img/avatar2.png', '/img/avatar3.png', '/img/avatar4.png']),
        'user_id' => function () {
            return User::all()->random();
        },
        'restaurant_basic_info_id' => function () {
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
