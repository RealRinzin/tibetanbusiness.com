<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventPhoto::class, function (Faker $faker) {
    return [
        //
        'path' => $faker->sentence(1),
        'event_basic_info_id' =>  function(){
            return EventBasicInfo::all()->random();
        },
        // 'event_basic_info_id' => "23432432safasdf sadf",
        'user_id' => function () {
            return User::all()->random();
        },
    ];
});
