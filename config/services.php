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
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'https://tibetanbusiness.com:8890/login/github/callback',
    ],
    // Facebook Login
    'facebook' => [
        'client_id' =>  '320651235266376',
        'client_secret' => 'ba5b7ff26f82df76340c456ba5802a94',
        'redirect' => 'https://tibetanbusiness.com:8890/login/facebook/callback',

    ],
    // google login
    'google' => [
        'client_id' =>  '225966495945-mhu9c7oqul22lfgmp74h81dglia1crqt.apps.googleusercontent.com',
        'client_secret' => 'OA_9drdpAyFdGL7B8Mp-xRrH',
        'redirect' => 'https://tibetanbusiness.com:8890/login/google/callback',

    ],

];
