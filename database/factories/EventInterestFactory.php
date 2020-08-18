<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventBasicInfo;
use App\Event\EventInterest;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventInterest::class, function (Faker $faker) {
    return [
        'event_basic_info_id' =>  function () {
            return EventBasicInfo::all()->random();
        },
        // 'event_basic_info_id' => "23432432safasdf sadf",
        'user_id' => function () {
            return User::all()->random();
        },
    ];
});
