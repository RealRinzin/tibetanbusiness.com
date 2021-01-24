<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\Location\Location;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventBasicInfo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name(),
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg']),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 1), // 48.8932,
        'entry_free' => $faker->randomElement([true,false]),
        'rate_color' => $faker->word(),
        'card' => 'card',
        'thumb' => 'thumb',
        'email' => $faker->email(),
        'location' => $faker->word(),
        'longitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 2), // 48.8932,
        'latitude' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 2), // 48.8932,
        'category' => $faker->word(),
        'address' => $faker->address(),
        'mobile_no' => $faker->numberBetween($min = 8000000000, $max = 9999999999),
        'entry_fee' => $faker->randomFloat($max=999999),
        'start_date' => $faker->date('2020-12-12'),
        'end_date' => $faker->date(),
        'description' => $faker->sentence(),
        'start_time' => $faker->time($format = 'h:i', $max = 'now'),
        'end_time' => $faker->time($format = 'h:i', $max = 'now'),
        'instagram' => $faker->url(100),
        'facebook' => $faker->url(100),
        'website' => $faker->url(100),
        'status' => $faker->boolean([true,false]),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();
        }
    ];
});
