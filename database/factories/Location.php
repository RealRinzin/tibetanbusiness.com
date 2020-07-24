<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
    ];
});
