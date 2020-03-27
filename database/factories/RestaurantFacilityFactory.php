<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFacility;
use Faker\Generator as Faker;

$factory->define(RestaurantFacility::class, function (Faker $faker) {
    return [
        'home_delivery' => $faker->randomElement(['1', '0']),
        'wifi' => $faker->randomElement(['1', '0']),
        'party_booking' => $faker->randomElement(['1', '0']),
        'roof_top' => $faker->randomElement(['1', '0']),
        'ac' => $faker->randomElement(['1', '0']),
        'veg' => $faker->randomElement(['1', '0']),
        'none_veg' => $faker->randomElement(['1', '0']),
        'beverage' => $faker->randomElement(['1', '0']),
        'restaurant_basic_info_id' => function () {
            // return User::all()->random();
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
