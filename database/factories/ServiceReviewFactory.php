<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service\ServiceBasicInfo;
use App\Service\ServiceReview;
use App\User;
use Faker\Generator as Faker;

$factory->define(ServiceReview::class, function (Faker $faker) {
    return [
        //
        'review' => $faker->sentence(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'name' => 'Tenzin',
        'avatar' => 'Profile picture',
        'user_id' => function () {
            return User::all()->random();
        },
        'service_basic_info_id' => function () {
            return ServiceBasicInfo::all()->random();
        }
    ];
});
