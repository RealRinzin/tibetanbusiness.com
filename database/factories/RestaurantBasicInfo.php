<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantBasicInfo::class, function (Faker $faker) {
    return [
        //
        'id' => $faker->sentence(),
        'name' => $faker->sentence(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'address' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100), // 48.8932,
        'banner' => $faker->sentence(),
        'location' => $faker->text(),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'email' => $faker->sentence(),
        'opening_hour' => $faker->randomDigit(),
        'closing_hour' => $faker->randomDigit(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
        'website' => $faker->text(100),
        'status' => $faker->randomElement(['1','0']),
        'description' => $faker->sentence(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();

        }
    ];
});
