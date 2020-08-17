<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Service\ServiceReview;
use App\Service\ServiceReviewReply;
use App\User;
use Faker\Generator as Faker;

$factory->define(ServiceReviewReply::class, function (Faker $faker) {
    return [
        //
        'reply' => $faker->sentence(),
        'name' => 'Tenzin',
        'avatar' => '/img/tibetanbusiness.png',
        'user_id' => function () {
            return User::all()->random();
        },
        'service_review_id' => function () {
            return ServiceReview::all()->random();
        }
    ];
});
