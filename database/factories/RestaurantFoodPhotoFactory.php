<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantFoodPhoto;
use App\Restaurant\RestaurantBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantFoodPhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'restaurant_basic_info_id' => function(){
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
