<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        // 'rate_color' =>$faker->sentence(),
        'address' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100), // 48.8932,
        'banner' => $faker->sentence(),
        'location' => $faker->sentence(1),
        'longitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 400), // 48.8932,
        'latitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 400), // 48.8932,
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'email' => $faker->sentence(),
        'opening_hour' => $faker->randomDigit(),
        'closing_hour' => $faker->randomDigit(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
        'website' => $faker->text(100),
        'status' => $faker->boolean(),
        'description' => $faker->sentence(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();

        }
    ];
});
