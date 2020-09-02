<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale\SaleBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(SaleBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'price' => $faker->numberBetween($min = 0, $max = 99999),
        'total_item' => $faker->randomDigit(),
        'address' => $faker->address(), // 48.8932,
        'location' => $faker->word(),
        'type' => $faker->word(),
        'mobile_no' => $faker->numberBetween($min = 8000000000, $max = 9999999999),
        'status' => $faker->boolean(),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'description' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        }
    ];
});
