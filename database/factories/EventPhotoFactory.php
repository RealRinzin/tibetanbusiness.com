<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventPhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'event_basic_info_id' =>  function(){
            return EventBasicInfo::all()->random();
        },
        'thumb' => 'thumb',
        // 'event_basic_info_id' => "23432432safasdf sadf",
        'user_id' => function () {
            return User::all()->random();
        },
    ];
});
