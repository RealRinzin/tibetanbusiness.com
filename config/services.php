<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    /**
     *  Laravel Socialite
     * Login
     *  */ 
    // Github Login
    'github' => [
        'client_id' => 'af90d1f6d8d6b2d17d8a',
        'client_secret' => 'd34dfce062e15d755520cf9572ae359187f304b0',
        'redirect' => 'https://tibetanbusiness.com:8890/login/github/callback',
    ],
    // Facebook Login
    'facebook' => [
        'client_id' =>  '3727328730617726',
        'client_secret' => '1f8e16bd7bb2d63b1d61dc0a5ede97fd',
        'redirect' => 'https://tibetanbusiness.com:8890/login/facebook/callback',

    ],
    // google login
    'google' => [
        'client_id' =>  '399145378972-9s3hth2mlqrl4q1cv3go0090fqal383g.apps.googleusercontent.com',
        'client_secret' => 'p2XcdJ-aQ-L5th0gHJjdeESP',
        'redirect' => 'https://demo.tibetanbusiness.com/login/google/callback',

    ],

];
