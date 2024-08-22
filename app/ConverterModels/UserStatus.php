<?php

namespace App\ConverterModels;

class UserStatus
{
    public static $value = [
        'Pending' => 1,
        'Active' => 2,
    ];

    public static $text = [
        1 => 'Pending',
        2 => 'On The Way',
    ];
}
