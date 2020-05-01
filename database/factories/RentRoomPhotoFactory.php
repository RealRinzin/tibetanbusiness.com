<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rent\RentBasicInfo;
use App\Rent\RentRoomPhoto;
use App\User;
use Faker\Generator as Faker;

$factory->define(RentRoomPhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'rent_basic_info_id' => function () {
            return RentBasicInfo::all()->random();
        }
    ];
});
