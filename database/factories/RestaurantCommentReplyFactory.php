<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Restaurant\RestaurantComment;
use App\Restaurant\RestaurantCommentReply;
use App\User;
use Faker\Generator as Faker;

$factory->define(RestaurantCommentReply::class, function (Faker $faker) {
    return [
        //
        'reply' => $faker->sentence(),
        'name' => 'Tenzin',
        'avatar' => 'Profile picture',
        'user_id' => function () {
            return User::all()->random();
        },
        'restaurant_comment_id' => function () {
            return RestaurantComment::all()->random();
        }
    ];
});
