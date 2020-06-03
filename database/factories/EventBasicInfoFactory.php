<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'banner' => $faker->sentence(1),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'rate_color' => $faker->sentence(),
        'email' => $faker->sentence(),
        'location' => $faker->sentence(1),
        'category' => $faker->sentence(),
        'address' => $faker->sentence(1),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'entry_fee' => $faker->randomFloat(),
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'description' => $faker->sentence(),
        'time' => $faker->sentence(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
        'website' => $faker->text(100),
        'status' => $faker->boolean(),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();
        }
    ];
});
