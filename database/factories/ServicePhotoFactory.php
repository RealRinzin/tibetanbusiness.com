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
        'path' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'service_basic_info_id' => function () {
            return ServiceBasicInfo::all()->random();
        }
    ];
});
