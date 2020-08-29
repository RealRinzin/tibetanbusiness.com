<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service\ServiceBasicInfo;
use App\Service\ServicePhoto;
use App\User;
use Faker\Generator as Faker;

$factory->define(ServicePhoto::class, function (Faker $faker) {
    return [
        //
        //
        'path' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'user_id' => function () {
            return User::all()->random();
        },
        'service_basic_info_id' => function () {
            return ServiceBasicInfo::all()->random();
        }
    ];
});
