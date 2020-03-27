<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantOperationDay;
use Faker\Generator as Faker;

$factory->define(RestaurantOperationDay::class, function (Faker $faker) {
    return [
        //
        'monday' => $faker->randomElement(['1', '0']),
        'tuesday' => $faker->randomElement(['1', '0']),
        'wednesday' => $faker->randomElement(['1', '0']),
        'thursday' => $faker->randomElement(['1', '0']),
        'friday' => $faker->randomElement(['1', '0']),
        'saturday' => $faker->randomElement(['1', '0']),
        'sunday' => $faker->randomElement(['1', '0']),
        'restaurant_basic_info_id' => function () {
            // return User::all()->random();
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
