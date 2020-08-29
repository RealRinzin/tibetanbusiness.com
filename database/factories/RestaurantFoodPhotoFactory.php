<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant\RestaurantFoodPhoto;
use App\Restaurant\RestaurantBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantFoodPhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'user_id' => function () {
            return User::all()->random();
        },
        'restaurant_basic_info_id' => function(){
            return RestaurantBasicInfo::all()->random();
        }
    ];
});
