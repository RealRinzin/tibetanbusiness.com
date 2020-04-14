<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantOperationDay;
use Faker\Generator as Faker;

$factory->define(RestaurantOperationDay::class, function (Faker $faker) {
    return [
        //
        'monday' => $faker->boolean([true, false]),
        'tuesday' => $faker->boolean(),
        'wednesday' => $faker->boolean(),
        'thursday' => $faker->boolean(),
        'friday' => $faker->boolean(),
        'saturday' => $faker->boolean(),
        'sunday' => $faker->boolean(),
        'restaurant_basic_info_id' => function () {
            // return User::all()->random();
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
