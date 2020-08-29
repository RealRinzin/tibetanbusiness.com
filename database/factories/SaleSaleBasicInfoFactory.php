<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale\SaleBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(SaleBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'total_item' => $faker->randomDigit(),
        'address' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100), // 48.8932,
        'location' => $faker->sentence(1),
        'type' => $faker->sentence(1),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->boolean(),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'description' => $faker->sentence(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();
        }
    ];
});
