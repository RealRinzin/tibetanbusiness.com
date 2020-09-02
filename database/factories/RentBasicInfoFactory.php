<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rent\RentBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RentBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),
        'fare' => $faker->numberBetween($min = 0, $max = 99999),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5), // 48.8932,
        'rate_color' =>$faker->word(),
        'address' => $faker->address(),
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'location' => $faker->word(),
        'mobile_no' => $faker->numberBetween($min = 8000000000, $max = 9999999999),
        'email' => $faker->email(),
        'accomodation_size' => $faker->randomDigit(),
        'instagram' => $faker->url(100),
        'facebook' => $faker->url(100),
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
