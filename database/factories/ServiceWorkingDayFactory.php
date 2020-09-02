<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service\ServiceBasicInfo;
use App\Service\ServiceWorkingDay;
use Faker\Generator as Faker;

$factory->define(ServiceWorkingDay::class, function (Faker $faker) {
    return [
        //
        'monday' => $faker->boolean([true, false]),
        'tuesday' => $faker->boolean([true, false]),
        'wednesday' => $faker->boolean([true, false]),
        'thursday' => $faker->boolean([true, false]),
        'friday' => $faker->boolean([true, false]),
        'saturday' => $faker->boolean([true, false]),
        'sunday' => $faker->boolean([true, false]),
        'service_basic_info_id' => function () {
            return ServiceBasicInfo::all()->random();
        }
    ];
});
