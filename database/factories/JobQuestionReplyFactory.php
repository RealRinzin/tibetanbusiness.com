<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job\JobQuestion;
use App\Job\JobQuestionReply;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobQuestionReply::class, function (Faker $faker) {
    return [
        //
        'reply' => $faker->sentence(),
        'name' => 'Tenzin',
        'avatar' => 'Profile picture',
        'user_id' => function () {
            return User::all()->random();
        },
        'job_question_id' => function () {
            return JobQuestion::all()->random();
        }
    ];
});
