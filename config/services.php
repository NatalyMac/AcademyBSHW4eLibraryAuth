<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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

    'github' => [
        'client_id' => 'c8e69a76a6de3b4a99ba',
        'client_secret' => '15462872afcf45eb7527c815e024ea49b1422f53',
        'redirect' => 'http://localhost/eLibraryAuth/public/index.php/socialite/github/callback',
    ],


    'facebook' => [
        'client_id' => '1760230014262494',
        'client_secret' => 'aa8b2ebf53ba3b60d04a7d90d381afc3',
        'redirect' => 'http://localhost/eLibraryAuth/public/index.php/socialite/facebook/callback',
    ],
];
