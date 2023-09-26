<?php

namespace App\ConverterModels;

class OrderStatus
{
    public static $value = [
        'Pending' => 1,
        'On The Way' => 2,
        'Delivered' => 3,
        'Cancelled' => 4,
    ];

    public static $value_ar = [
        'قيد الإنتظار' => 1,
        'جاري التوصيل' => 2,
        'تم التوصيل' => 3,
        'ملغي' => 4,
    ];

    public static $text = [
        1 => 'Pending',
        2 => 'On The Way',
        3 => 'Delivered',
        4 => 'Cancelled',
    ];

    public static $text_ar = [
        1 => 'قيد الإنتظار',
        2 => 'جاري التوصيل',
        3 => 'تم التوصيل',
        4 => 'ملغي',
    ];
}
