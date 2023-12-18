<?php

return [
    'enabled_currencies' => [
        'USD',
        'TRY',
        'EUR',
        'AED',
        'GBP'
    ],

    'default_gateway' => \App\Gateways\ExchangeRateApi::class
];
