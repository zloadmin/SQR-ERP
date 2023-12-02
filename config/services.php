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
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme'   => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses'          => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'sqrcard'      => [
        'key'                   => env('SQRCARD_KEY'),
        'client_domain'         => env('SQRCARD_CLIENT_DOMAIN'),
        'update_status_webhook' => env('SQRCARD_UPDATE_STATUS_WEBHOOK', 'https://sqrcard.com/api/v1/order/update_status')
    ],
    'telegram_api' => [
        'url'      => env('TELEGRAM_API_URL', 'https://telegram-api.sqrneo.com/api/telegram/send-message'),
        'login'    => env('TELEGRAM_API_LOGIN', 'admin'),
        'password' => env('TELEGRAM_API_PASSWORD')
    ],
    'aramex'       => [
        'env'  => env('ARAMEX_ENV', 'test'),
        'test' => [
            'AccountNumber'      => env('ARAMEX_TEST_ACCOUNT_NUMBER'),
            'UserName'           => env('ARAMEX_TEST_USERNAME'),
            'Password'           => env('ARAMEX_TEST_PASSWORD'),
            'AccountPin'         => env('ARAMEX_TEST_ACCOUNT_PIN'),
            'AccountEntity'      => env('ARAMEX_TEST_ACCOUNT_ENTITY'),
            'Version'            => env('ARAMEX_TEST_VERSION'),
            'AccountCountryCode' => env('ARAMEX_TEST_ACCOUNT_COUNTRY_CODE'),
        ],
        'prod' => [
            'AccountNumber'      => env('ARAMEX_PROD_ACCOUNT_NUMBER'),
            'UserName'           => env('ARAMEX_PROD_USERNAME'),
            'Password'           => env('ARAMEX_PROD_PASSWORD'),
            'AccountPin'         => env('ARAMEX_PROD_ACCOUNT_PIN'),
            'AccountEntity'      => env('ARAMEX_PROD_ACCOUNT_ENTITY'),
            'Version'            => env('ARAMEX_PROD_VERSION'),
            'AccountCountryCode' => env('ARAMEX_PROD_ACCOUNT_COUNTRY_CODE'),
        ]
    ]
];
