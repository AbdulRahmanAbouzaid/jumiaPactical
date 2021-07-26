<?php

namespace App\Helpers;

class Data {
    const COUNTRIES_LIST = [
        '237' => [
            'name' => 'Cameroon',
            'regex' => '\(237\)\ ?[2368]\d{7,8}$'
        ],
        '251' => [
            'name' => 'Ethiopia',
            'regex' => '\(251\)\ ?[1-59]\d{8}$'
        ],
        '212' => [
            'name' => 'Morocco',
            'regex' => '\(212\)\ ?[5-9]\d{8}$'
        ],
        '258' => [
            'name' => 'Mozambique',
            'regex' => '\(258\)\ ?[28]\d{7,8}$'
        ],
        '256' => [
            'name' => 'Uganda',
            'regex' => '\(256\)\ ?\d{9}$'
        ]
    ];
}