<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job\JobBasicInfo;
use App\Job\JobQuestion;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobQuestion::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'question' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'job_basic_info_id' => function () {
            return JobBasicInfo::all()->random();
        },
    ];
});
