<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service\ServiceBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(ServiceBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5), // 48.8932,
        'rate_color' =>$faker->sentence(1),
        'type' => $faker->word(),
        'card' => 'card',
        'thumb' => 'thumb',
        'address' => $faker->address(), // 48.8932,
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'location' => $faker->word(),
        'longitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 2), // 48.8932,
        'latitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 2), // 48.8932,
        'mobile_no' => $faker->numberBetween($min = 8000000000, $max = 9999999999),
        'email' => $faker->email(),
        'opening_hour' => $faker->time($format = 'h:i', $max = 'now'),
        'closing_hour' => $faker->time($format = 'h:i', $max = 'now'),
        'instagram' => $faker->url(100),
        'facebook' => $faker->url(100),
        'website' => $faker->url(100),
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
