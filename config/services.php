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
        'client_id' => '2975f9fe8f0c66f5aa7b',
        'client_secret' => 'e4cbd66472e19f57bcda1925460c3a064f6d1656',
        'redirect' => 'https://demo.tibetanbusiness.com/login/github/callback',
    ],
    // Facebook Login
    'facebook' => [
        'client_id' =>  '716233402441348',
        'client_secret' => 'e48cab5f81eba7e5ad72c9e068a3a094',
        'redirect' => 'https://demo.tibetanbusiness.com/login/facebook/callback',

    ],
    // google login
    'google' => [
        'client_id' =>  '694425608507-kdlo4rn3mfucg55f0q2lc191vbd8po2u.apps.googleusercontent.com',
        'client_secret' => 't7thLrp2t8nzSo0LovnIg_So',
        'redirect' => 'http://tibetanbusiness.com:8888/login/google/callback',

    ],

];
