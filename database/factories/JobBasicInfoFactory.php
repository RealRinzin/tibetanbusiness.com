<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job\JobBasicInfo;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobBasicInfo::class, function (Faker $faker) {
    return [
        //
        'banner' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg']),
        'organization' => $faker->word(),
        'title' => $faker->word(),
        'thumb' => 'thumb',
        'card' => 'card',
        'profession' => $faker->word(),
        'experience' => $faker->randomElement(['Not Required', '6 Months', '1 Yrs', '2 Yrs', '3 Yrs', '4 Yrs', '5 Yrs', '6 Yrs above']),
        'nature' => $faker->word(),
        'salary' => $faker->numberBetween($min=0,$max = 99999),
        'mobile_no' => $faker->numberBetween($min = 8000000000, $max = 9999999999),
        'address' => $faker->address(1),
        'location' => $faker->word(1),
        'email' => $faker->email(),
        'instagram' => $faker->url(100),
        'facebook' => $faker->url(100),
        'website' => $faker->url(100),
        'status' => $faker->boolean(),
        'featured_ad' => $faker->boolean(),
        'home_ad' => $faker->boolean(),
        'sidebar_ad' => $faker->boolean(),
        'description' => $faker->sentence(),
        'deadline'=>$faker->date('2020-12-12'),
        'user_id' => function () {
            return User::all()->random();
        }
    ];
});
