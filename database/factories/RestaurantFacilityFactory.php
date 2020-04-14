<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\Restaurant\RestaurantFacility;
use Faker\Generator as Faker;

$factory->define(RestaurantFacility::class, function (Faker $faker) {
    return [
        'home_delivery' => $faker->boolean(),
        'wifi' => $faker->boolean(),
        'party_booking' => $faker->boolean(),
        'roof_top' => $faker->boolean(),
        'ac' => $faker->boolean(),
        'veg' => $faker->boolean(),
        'none_veg' => $faker->boolean(),
        'beverage' => $faker->boolean(),
        'parking_lot' => $faker->boolean(),
        'card_payment' => $faker->boolean(),
        'restaurant_basic_info_id' => function () {
            // return User::all()->random();
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
