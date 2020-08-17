<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event\EventReview;
use App\Event\EventReviewReply;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(EventReviewReply::class, function (Faker $faker) {
    return [
        //
        //
        'reply' => $faker->sentence(),
        'name' => 'Tenzin',
        'avatar' => '/img/tibetanbusiness.png',
        'user_id' => function () {
            return User::all()->random();
        },
        'event_review_id' => function () {
            return EventReview::all()->random();
        }
    ];
});
