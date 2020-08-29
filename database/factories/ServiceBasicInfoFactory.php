<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service\ServiceBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(ServiceBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'rate_color' =>$faker->sentence(1),
        'type' => $faker->sentence(20),
        'address' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100), // 48.8932,
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'location' => $faker->sentence(1),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'email' => $faker->sentence(),
        'opening_hour' => $faker->randomDigit(),
        'closing_hour' => $faker->randomDigit(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
        'website' => $faker->text(100),
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
