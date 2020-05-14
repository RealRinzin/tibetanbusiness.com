<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job\JobAnswer;
use App\Job\JobBasicInfo;
use App\Job\JobQuestion;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobAnswer::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->sentence(1),
        'avatar' => 'Profile picture',
        'answer' => $faker->sentence(),
        'user_id' => function () {
            return User::all()->random();
        },
        'job_basic_info_id' => function () {
            return JobBasicInfo::all()->random();
        },
        'job_question_id' => function () {
            return JobQuestion::all()->random();
        },
    ];
});
