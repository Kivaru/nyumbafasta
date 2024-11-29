<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'google' => [
        'client_id' => '1007005377030-1qcgu8kg64a62auec4b2eia2q2qpk5jg.apps.googleusercontent.com',
        'client_secret' => 'VUM1lJK3DFrDL38kfazxtvlE',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '1124279105134003',
        'client_secret' => '70d6c51e867e3571855385f382c30832',
        'redirect' => 'http://localhost:8000/callback/facebook',
      ],

    'twitter' => [
        'client_id' => 'HK90i9iBn60NaeASxbhWleJLc',
        'client_secret' => '07PfH2NJakLcgXT7vr7wQwyVj19Rnfq98eUIRK5DbxnCixyUFt',
        'redirect' => 'http://localhost:8000/callback/twitter',
     ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
