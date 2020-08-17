<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Rent\RentComment;
use App\Rent\RentCommentReply;
use App\User;
use Faker\Generator as Faker;

$factory->define(RentCommentReply::class, function (Faker $faker) {
    return [
        //
        'reply' => $faker->sentence(),
        'name' => 'Tenzin',
        'avatar' => '/img/tibetanbusiness.png',
        'user_id' => function () {
            return User::all()->random();
        },
        'rent_comment_id' => function () {
            return RentComment::all()->random();
        }
    ];
});
