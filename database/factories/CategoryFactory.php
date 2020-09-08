<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'category' => $faker->randomElement(['job','service','event','sale'])
        //
    ];
});
