<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job\JobBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobBasicInfo::class, function (Faker $faker) {
    return [
        //
        'banner' => $faker->sentence(),
        'title' => $faker->sentence(1),
        'profession' => $faker->sentence(1),
        'experience' => $faker->sentence(1),
        'nature' => $faker->sentence(1),
        'salary' => $faker->randomFloat(),
        'mobile_no' => $faker->numberBetween($min = 1000, $max = 9000),
        'address' => $faker->sentence(1),
        'location' => $faker->sentence(1),
        'email' => $faker->sentence(),
        'instagram' => $faker->text(100),
        'facebook' => $faker->text(100),
        'website' => $faker->text(100),
        'status' => $faker->boolean(),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'description' => $faker->sentence(),
        'deadline'=>$faker->date(),
        'user_id' => function () {
            // return User::all()->random();
            return User::all()->random();
        }
    ];
});
