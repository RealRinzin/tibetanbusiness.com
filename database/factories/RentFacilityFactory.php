<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rent\RentBasicInfo;
use App\Rent\RentFacility;
use Faker\Generator as Faker;

$factory->define(RentFacility::class, function (Faker $faker) {
    return [
        'geyser' => $faker->boolean(),
        'wifi' => $faker->boolean(),
        'ac' => $faker->boolean(),
        'washing_machine' => $faker->boolean(),
        'single_room' => $faker->boolean(),
        'double_room' => $faker->boolean(),
        'bathroom_attached' => $faker->boolean(),
        'fridge' => $faker->boolean(),
        'pet_allowed' => $faker->boolean(),
        'gym' => $faker->boolean(),
        'garden' => $faker->boolean(),
        'rent_basic_info_id' => function () {
            // return User::all()->random();
            return RentBasicInfo::all()->random();
        }
    ];
});
