<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Sell and Buy Products - Product Search - Product Filter - '.env('APP_NAME'),
            'description'  => env('APP_NAME').' - Sell and Buy Products in Australia. Sell the used or brand new products. Contact the buyer yourself. Look for the products of your desire.',
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => env('APP_URL'), // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Sell and Buy Products - Product Search - Product Filter - '.env('APP_NAME'),
            'description' => env('APP_NAME').' - Sell and Buy your products in Australia. Sell the used or brand new products. Contact the buyer yourself. Look for the products of your desire.',
            'url'         => env('APP_URL'), // Set null for using Url::current(), set false to total remove
            'type'        => 'e-commerce',
            'site_name'   => env('APP_NAME'),
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
