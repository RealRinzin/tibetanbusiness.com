<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rent\RentBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RentBasicInfo::class, function (Faker $faker) {
    return [
        //
        //
        'name' => $faker->sentence(1),
        'fare' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        // 'rate_color' =>$faker->sentence(),
        'address' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100), // 48.8932,
        'banner' => $faker->sentence(),
        'location' => $faker->sentence(1),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'email' => $faker->sentence(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
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
