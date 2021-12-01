<?php

return [
    'name' => 'LinkedList',
    'manifest' => [
        'name' => env('APP_NAME', 'LinkedList'),
        'short_name' => 'LL',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-640x1136.png',
            '750x1334' => '/images/icons/splash-640x1136.png',
            '828x1792' =>  '/images/icons/splash-640x1136.png',
            '1125x2436' => '/images/icons/splash-640x1136.png',
            '1242x2208' => '/images/icons/splash-640x1136.png',
            '1242x2688' => '/images/icons/splash-640x1136.png',
            '1536x2048' => '/images/icons/splash-640x1136.png',
            '1668x2224' => '/images/icons/splash-640x1136.png',
            '1668x2388' => '/images/icons/splash-640x1136.png',
            '2048x2732' => '/images/icons/splash-640x1136.png',
        ],
        'shortcuts' => [],
        'custom' => []
    ]
];
