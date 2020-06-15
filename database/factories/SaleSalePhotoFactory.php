<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale\SaleBasicInfo;
use App\Sale\SalePhoto;
use App\User;
use Faker\Generator as Faker;

$factory->define(SalePhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'sale_basic_info_id' => function () {
            return SaleBasicInfo::all()->random();
        }
    ];
});
