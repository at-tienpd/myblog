<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
    'client_id' => '1789892884608521', // configure with your app id
    'client_secret' => 'dcde370fa812f9e21cf973fc162167f8', // your app secret
    'redirect' => 'http://localhost/callback/facebook', // leave blank for now
    ],
    'twitter' => [
    'client_id' => '4Od7zaF0wVskWAyW6mn5jFlH0', // configure with your app id
    'client_secret' => 'r8kZg8TCGEjUytWSLzY86C1qSH0VqITgm5y6zWrOCHypTReJWN', // your app secret
    'redirect' => 'http://localhost/callback/twitter', // leave blank for now
    ],

];
