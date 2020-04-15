<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantOperationDay;
use Faker\Generator as Faker;

$factory->define(RestaurantOperationDay::class, function (Faker $faker) {
    return [
        //
        'monday' => $faker->boolean([true, false]),
        'tuesday' => $faker->boolean([true,false]),
        'wednesday' => $faker->boolean([true, false]),
        'thursday' => $faker->boolean([true, false]),
        'friday' => $faker->boolean([true, false]),
        'saturday' => $faker->boolean([true, false]),
        'sunday' => $faker->boolean([true, false]),
        'restaurant_basic_info_id' => function () {
            // return User::all()->random();
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
