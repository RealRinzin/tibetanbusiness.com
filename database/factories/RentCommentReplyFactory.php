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
        'name' => $faker->randomElement(['Rinzin', 'Tashi', 'Dorjee', 'Passang', 'Dolma']),
        'avatar' => $faker->randomElement(['/img/avatar1.png', '/img/avatar2.png', '/img/avatar3.png', '/img/avatar4.png']),
        'user_id' => function () {
            return User::all()->random();
        },
        'rent_comment_id' => function () {
            return RentComment::all()->random();
        }
    ];
});
