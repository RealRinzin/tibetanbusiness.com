<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SaleCategory;
use Faker\Generator as Faker;

$factory->define(SaleCategory::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),

    ];
});
