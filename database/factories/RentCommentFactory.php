<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rent\RentBasicInfo;
use App\Rent\RentComment;
use App\User;
use Faker\Generator as Faker;

$factory->define(RentComment::class, function (Faker $faker) {
    return [
        //
        'comment' => $faker->sentence(),
        'rate' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10), // 48.8932,
        'name' => 'Tenzin',
        'avatar' => 'Profile picture',
        'user_id' => function () {
            return User::all()->random();
        },
        'rent_basic_info_id' => function () {
            return RentBasicInfo::all()->random();
        }
    ];
});
