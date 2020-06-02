<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\Event\EventReview;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventReview::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'avatar' => 'profile picture',
        'review' => $faker->sentence(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'rate_color' =>'',
        //
        'event_basic_info_id' =>  function () {
            return EventBasicInfo::all()->random();
        },
        'user_id' => function () {
            return User::all()->random();
        },
    ];
});
