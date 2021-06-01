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
        'client_secret' => 'a11cc0b3bf4405dcc1cc0f9dc78533b140f827f4',
        'redirect' => 'https://www.tibetanbusiness.com/login/github/callback',
    ],
    // Facebook Login
    'facebook' => [
        'client_id' =>  '519046146132488',
        'client_secret' => 'b60038b079aaab187ad20b20a9e9aac4',
        'redirect' => 'https://www.tibetanbusiness.com/login/facebook/callback',
    ],
    // google login
    'google' => [
        'client_id' =>  '694425608507-kdlo4rn3mfucg55f0q2lc191vbd8po2u.apps.googleusercontent.com',
        'client_secret' => 't7thLrp2t8nzSo0LovnIg_So',
        'redirect' => 'http://www.tibetanbusiness.com/login/google/callback',

    ],

];
